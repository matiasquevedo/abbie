<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Hora;
use App\Tarea;
use Illuminate\Support\Facades\DB;

class HorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proyectoId)
    {
        
        $proyecto = Proyecto::find($proyectoId);
        $tareas = DB::table('tareas')->where('proyecto_id',$proyectoId)->pluck('name','id');
        //dd($tareas);
        //          dd($proyecto);
        return view('admin.horas.create')->with("proyecto",$proyecto)->with("tareas",$tareas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        dd($request);
        $hora = new Hora($request->all());
        $hora->tarea_id = $request->tarea_id;
        $hora->proyecto_id = $request->proyecto_id;
        $hora->user_id = \Auth::user()->id;
        $hora->save();
        $tarea = Tarea::find($hora->tarea_id);
        $tarea->totaldeHoras=$tarea->totaldeHoras+$hora->horas;
        $tarea->save();        
        $proyecto = Proyecto::find($hora->proyecto_id);
        $proyecto->totaldeHoras=$proyecto->totaldeHoras+$request->horas;
        
        $proyecto->precioTotal=$proyecto->totaldeHoras*$proyecto->precio;
        $proyecto->save(); 
        //dd($proyecto->totaldeHoras,$request->horas);
        flash('Se a creado las horas de trabajo ' . $hora->name)->success();
        return redirect()->route('proyectos.show',$hora->proyecto_id);
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
        $hora = Hora::find($id);
        return view('admin.horas.show')->with("hora",$hora);
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
        $hora = Hora::find($id);
        $tareas = DB::table('tareas')->where('proyecto_id',$hora->proyecto->id)->pluck('name','id');
        return view('admin.horas.edit')->with("hora",$hora)->with("tareas",$tareas);
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
        $hora = Hora::find($id);
        if ($request->horas == $hora->horas) {
            # code...
            //dd("las horas no han cambiado");
            $hora->fill($request->all());
            $hora->tarea_id = $request->tarea_id;        
            $hora->save();
            flash('Se a editado las horas n°:' . $hora->id)->success();
        } else {
            //dd("cambiaron las horas");
            $tarea = Tarea::find($hora->tarea_id);
            $tarea->totaldeHoras=$tarea->totaldeHoras+$hora->horas;
            $tarea->save();        
            $proyecto = Proyecto::find($hora->proyecto_id);
            $proyecto->totaldeHoras=$proyecto->totaldeHoras+$request->horas;
            
            $proyecto->precioTotal=$proyecto->totaldeHoras*$proyecto->precio;
            $proyecto->save();
            flash('Se a editado las horas n°:' . $hora->id)->success();
            flash('Se modifico la cantidad de horas' )->success();
        }
        //dd($hora,$request);        
        return redirect()->route('proyectos.show',$hora->proyecto_id);
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
        $hora = Hora::find($id);
        $tarea = Tarea::find($hora->tarea_id);
        $tarea->totaldeHoras=$tarea->totaldeHoras-$hora->horas;
        $tarea->save();        
        $proyecto = Proyecto::find($hora->proyecto_id);
        $proyecto->totaldeHoras=$proyecto->totaldeHoras-$hora->horas;
        
        $proyecto->precioTotal=$proyecto->totaldeHoras*$proyecto->precio;
        $proyecto->save();
        $hora->delete();
        flash('Se a eliminado las horas del dia' . $hora->fecha)->error();
        return redirect()->route('proyectos.show',$hora->proyecto_id);
    }
}
