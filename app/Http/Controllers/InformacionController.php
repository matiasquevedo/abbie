<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informacion;
use App\Category;
use App\imagesInformacion;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $informaciones = Informacion::orderBy('id','ASC')->paginate(7);
        return view('admin.informacion.index')->with('informaciones',$informaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        return view('admin.informacion.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->file('image')){
            $file = $request->file('image');
            $name = 'embalsa_informacion' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/images/informacion/';
            $file->move($path,$name);
        }

        $informacion = new Informacion($request->all());
        $informacion->user_id = \Auth::user()->id;
        $informacion->save();

        $image = new ImagesInformacion();
        $image->foto = $name;
        $image->informacion()->associate($informacion);
        $image->save();


        flash('Se ha creado la informacion ' .$informacion->title)->success();
        return redirect()->route('informacion.index');
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
        $informacion = Informacion::find($id);
        $image = DB::table('imagesInformacion')->where('informacion_id',$id)->value('foto');
        return view('admin.informacion.show')->with('informacion',$informacion)->with('image',$image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $informacion = Informacion::find($id);
        $categories = Category::orderBy('name','ASC')->pluck('name','id');
        return view('admin.informacion.edit')->with('categories',$categories)->with('informacion',$informacion);
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
        //
        $informacion = Informacion::find($id);
        $informacion->fill($request->all());
        $informacion->save();
        flash('Se a editado la informacion ' . $informacion->title)->success();
        return redirect()->route('informacion.index');
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
        $informacion = Informacion::find($id);
        flash('Se ha eliminado la informacion '. $informacion->title)->error();
        $informacion->delete();
        return redirect()->route('informacion.index');
    }

    public function post($id){
        $informacion = Informacion::find($id);
        $informacion->state = '1';
        $informacion->save();
        flash('Se ha publicado la informacion ' . $informacion->title)->success();
        return redirect()->route('informacion.index');

    }

    public function undpost($id){
        $informacion = Informacion::find($id);
        $informacion->state = '0';
        $informacion->save();
        flash('Se ha despublicado la informacion ' . $informacion->title)->success();
        return redirect()->route('informacion.index');

    }



    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////---API---///////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////


    function ApiIndex(){
        $informaciones = DB::table('informacionespost')->get();
        $json = json_decode($informaciones,true);
        return response()->json(array('result'=>$json));
    }

    function ApiShow($id){
        $informaciones = Informacion::with('user','category')->get()->find($id);
        $json = json_decode($informaciones,true);
        return response()->json(array('result'=>$json));
    }
}
