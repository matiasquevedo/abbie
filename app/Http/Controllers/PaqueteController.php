<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paquete;
use App\Actividad;
use App\ActividadPaquete;
use Illuminate\Support\Facades\DB;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paquetes = Paquete::orderBy('id','DESC')->paginate(5);
        $paquetes->each(function($paquetes){
            $paquetes->user;
        });
        return view('admin.paquetes.index')->with('paquetes',$paquetes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $actividades = Actividad::orderBy('title','ASC')->pluck('title','id');
        return view('admin.paquetes.create')->with('actividades',$actividades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('todo ok');
        //dd($request);
        $paquete = new Paquete($request->all());
        $actividades = $request->input('actividades');
        $paquete->user_id = \Auth::user()->id;
        $paquete->save();
        //dd($actividades);
        if ($actividades == null) {      
            flash('El paquete debe incluir actividades')->error();
            $paquete->delete();
            return redirect()->route('paquetes.index');
        } else {

               foreach ($actividades as $b) {
                   # code...
                $actividadPaquete = new ActividadPaquete;
                $actividadPaquete->paquete_id = $paquete->id;
                $actividadPaquete->actividad_id= $b;
                $actividadPaquete->save();
               }
            
        }

        flash('Se creado el paquete ' . $paquete->title)->success();
        return redirect()->route('paquetes.index');
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
        $actividades = DB::table('actividadPaquete')->where('paquete_id',$id)->get();
        $paquete = Paquete::find($id);
        return view('admin.paquetes.show')->with('paquete',$paquete)->with('actividades',$actividades);
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
        $paquete = Paquete::find($id);
        return view('admin.paquetes.edit')->with('paquete',$paquete);
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
        $paquete = Paquete::find($id);
        $paquete->delete();
        flash('Se ha eliminado el paquete '.$paquete->title)->error();
        return redirect()->route('paquetes.index');
    }

    public function post($id){
        $paquete = Paquete::find($id);
        $paquete->state = '1';
        $paquete->save();
        flash('Se ha publicado el paquete ' . $paquete->title)->success();
        return redirect()->route('paquetes.index');

    }

    public function undpost($id){
        $paquete = Paquete::find($id);
        $paquete->state = '0';
        $paquete->save();
        flash('Se ha despublicado el paquete ' . $paquete->title)->success();
        return redirect()->route('paquetes.index');

    }


    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////
    //////////////////////////API//////////////////////////////////

    public function ApiIndex(){        
        $paquetes = DB::table('paquetespostview')->get();
        $json = json_decode($paquetes,true);
        return response()->json(array('result'=>$json));
    }

    public function ApiShow($id){ 
        $actividades = DB::table('actividadespaquetes')->where('paquete_id','LIKE',"%$id%")->get();        
        $json = json_decode($actividades,true);
        return response()->json(array('result'=>$json));
    }

    

}
