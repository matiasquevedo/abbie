<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Actividad;
use App\Image;
use App\User;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use File;
use Illuminate\Support\Facades\Storage;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $actividades = Actividad::orderBy('id','DESC')->paginate(20);
        $actividades->each(function($actividades){
            $actividades->category;
            $actividades->user;
        });
        //dd($actividades);
        return view('admin.articles.index')->with('actividades',$actividades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd("todo ok");
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        //dd($categories);
        return view('admin.articles.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Manipulacion de Imagenes
        //dd($request);
        if($request->file('image')){
            $file = $request->file('image');
            $name = 'actividad_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/images/actividades/';
            $file->move($path,$name);
        }
        $actividad = new Actividad($request->all());
        $actividad->user_id = \Auth::user()->id;
        $actividad->precioPublico = $request->precioPublico - (($request->precioPublico*$request->descuento)/100);
        $actividad->save();

        $image = new Image();
        $image->foto = $name;
        $image->actividad()->associate($actividad);
        $image->save();
        flash('Se creado la actividad ' . $actividad->title)->success();
        return redirect()->route('actividades.index');

    }

    public function EditorStore(ArticleRequest $request)
    {
        //Manipulacion de Imagenes
        if($request->file('image')){
            $file = $request->file('image');
            $name = 'diario_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/images/articles/';
            $file->move($path,$name);
        }
        $actividad = new Actividad($request->all());
        $actividad->user_id = \Auth::user()->id;
        $actividad->save();

        $image = new Image();
        $image->foto = $name;
        $image->article()->associate($article);
        $image->save();

        $article->tags()->sync($request->tags);
        flash('Se creado el articulo ' . $article->title)->success();
        return redirect()->route('editor.articles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $actividad = Actividad::find($id);
        $image = DB::table('images')->where('actividad_id',$id)->value('foto');
        

        return view('admin.articles.show')->with('actividad',$actividad)->with('image',$image);
    }

    public function post($id){
        $article = Actividad::find($id);
        $article->state = '1';
        $article->save();
        flash('Se a publicado el articulo: ' . $article->title)->success();
        return redirect()->route('actividades.index');
    }

    public function undpost($id){
        $article = Actividad::find($id);
        $article->state = '0';
        $article->save();
        flash('Se a despublicado el articulo: ' . $article->title)->error();
        return redirect()->route('actividades.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = Actividad::find($id);
        $image = DB::table('images')->where('actividad_id',$id)->value('foto');
        $actividad->category;
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        return view('admin.articles.edit')->with('categories',$categories)->with('actividad',$actividad)->with('image',$image);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $actividad = Actividad::find($id);
        $actividad->fill($request->all());
        $actividad->precioPublico = $request->precioPublico - (($request->precioPublico*$request->descuento)/100);
        $actividad->save();
        flash('Se a editado la actividad ' . $actividad->title)->success();
        return redirect()->route('actividades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $actividad = Actividad::find($id);
        $actividad->delete();
        flash('Se a eliminado la Actividad ' . $actividad->title)->error();
        return redirect()->route('actividades.index');
    }

    public function ImagesUpdate(Request $request){
        $actividad = Actividad::find($request->actividad_id);
        $imageD = Image::where('actividad_id',$request->actividad_id)->first();
        //
        if ($imageD == null) {
            if($request->file('image')){
                $file = $request->file('image');
                $name = 'actividad_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/images/actividades/';
                $file->move($path,$name);
            }
            $actividad->save();
            $image = new Image();
            $image->foto = $name;
            $image->actividad()->associate($actividad);
                    
            $image->save();
            # code...
        } else {                    
            $path = public_path() . '/images/actividades/';
            if (file_exists($path.$imageD->foto)) {
                $imageD->delete(); 
                File::delete($path.$imageD->foto);                if($request->file('image')){
                    $file = $request->file('image');
                    $name = 'actividad_' . time() . '.' . $file->getClientOriginalExtension();
                    $path = public_path() . '/images/actividades/';
                    $file->move($path,$name);
                }
                $actividad->save();
                $image = new Image();
                $image->foto = $name;
                $image->actividad()->associate($actividad);
                        
                $image->save();
            } else {
                //dd("sin imagen, sin archivo");
                $path = public_path() . '/images/actividades/';
                File::delete($path.$imageD->foto);
                if($request->file('image')){
                    $file = $request->file('image');
                    $name = 'actividad_' . time() . '.' . $file->getClientOriginalExtension();
                    $path = public_path() . '/images/actividades/';
                    $file->move($path,$name);
                }                
                $actividad->save();
                $image = new Image();
                $image->foto = $name;
                $image->actividad()->associate($actividad);
                        
                $image->save();
            }
        }
        

        //dd($image);
        flash('Se a cambiado la imagen de portada de la actividad ' . $actividad->title)->success();
        return redirect()->route('actividades.show',$actividad->id);
        
    }

    public function eliminarVarios(Request $request){
        $val=$request->act;
        $myCheckboxes = $request->input('box');

        if ($myCheckboxes == null) {            
            return redirect()->route('articles.index');
        } else {
            if ($val == '0') {

               foreach ($myCheckboxes as $b) {
                   # code...
                $article = Actividad::find($b);
                $article->delete();
               }
               return redirect()->route('actividades.index');
            } elseif ($val == '1') {
                foreach ($myCheckboxes as $b) {
                   # code...
                $article = Actividad::find($b);
                $article->state = '1';
                $article->save();
               }
               return redirect()->route('actividades.index');
                
            } elseif ($val == '2') {
                foreach ($myCheckboxes as $b) {
                   # code...
                $article = Actividad::find($b);
                $article->state = '0';
                $article->save();
               }
               return redirect()->route('actividades.index');
                
            }
            
        }
    }

    public function list(Request $request){
        $articles = Actividad::Search($request->title)->
        orderBy('id','DESC')->paginate(7);
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
        });
        return view('admin.noticias')->with('articles',$articles);
    }

    public function notificacion($id){

    }

    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    //////////////////////////////EDITOR!!!!!!!!!!!!///////////////////////////////////////////////////
    public function EditorIndex(Request $request){
       //$articles = Article::Search($request->title)->orderBy('id','ASC')->paginate(7);
        $id = \Auth::user()->id;
        $articles = DB::table('articles')->where('user_id','LIKE',"%$id%")->get();
        /*$articles->each(function($articles){
            $articles->category;
            $articles->user;
        });*/
        //dd($articles);
        return view('editor.articles.index')->with('articles',$articles);
    }

    public function EditorArticleCreate(){
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags = Tag::orderBy('name','ASC')->pluck('name','id');
        return view('editor.articles.create')->with('categories',$categories)->with('tags',$tags);

    }

    public function EditorArticleEdit($id){
        $article = Actividad::find($id);
        $article->category;
        $art_tags=$article->tags->pluck('id')->ToArray();
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        $tags = Tag::orderBy('name','ASC')->pluck('name','id');
       # dd($article);
        return view('editor.articles.edit')->with('categories',$categories)->with('tags',$tags)->with('article',$article)->with('art_tags',$art_tags);
    }

    public function EditorArticleUpdate(Request $request, $id)
    {
        //
        $article = Actividad::find($id);
        $article->fill($request->all());
        $article->save();
        $article->tags()->sync($request->tags);
        flash('Se a editado el articulo ' . $article->title)->success();
        return redirect()->route('editor.articles.index');
    }

    public function EditorArticleShow($id){
        $article = Actividad::find($id);
        $image = DB::table('images')->where('article_id',$id)->value('foto');        

        return view('editor.articles.show')->with('article',$article)->with('image',$image);

    }

    public function EditorArticleDestroy($id){
        $article = Actividad::find($id);
        $article->delete();
        flash('Se a eliminado el articulo ' . $article->title)->error();
        return redirect()->route('editor.articles.index');

    }

    public function EditorDocumentacion(){
        return view('editor.documentacion.doc');
    }

    public function PublicShow($id){
        $article = Article::find($id);
        $image = DB::table('images')->where('article_id',$id)->value('foto');
        //dd($article);

        return view('show')->with('article',$article)->with('image',$image);
    }

    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    //////////////////API///////////////////////////
    

    public function ApiIndex(){
        $actividades = DB::table('actividadespostview')->get();
        dd($actividades);
        $json = json_decode($actividades,true);
        return response()->json(array('result'=>$json));
    }

    public function ApiShow($id){
        $actividades = Actividad::with('user','category','images')->get()->find($id);
        $json = json_decode($actividades,true);
        return response()->json(array('result'=>$json));
    }

    public function ApiCategories(){
        $categories = Category::with('actividades','actividades.images', 'informaciones','informaciones.images')->get();
        $json = json_decode($categories,true);
        return response()->json(array('result'=>$json));
    }

    public function ApiActividadesByCategory($id){
        $category = DB::table('categoryactividadespost')->where('category_id','LIKE',"%$id%")->get();        
        $json = json_decode($category,true);
        return response()->json(array('result'=>$json));
    }

}

/*'title','state','title','content','user_id','category_id'

->with('categories',$categories)->with('tags',$tags)->with('article',$article)->with('art_tags',$art_tags);

*/