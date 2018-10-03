<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Tarea;

class TareasController extends Controller
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
        //        dd($proyecto);
        $proyecto = Proyecto::find($proyectoId);
        return view('admin.tareas.create')->with("proyecto",$proyecto);
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
        $tarea = new Tarea($request->all());
        $tarea->proyecto_id = $request->proyecto_id;
        $tarea->totaldeHoras = '0';
        $tarea->user_id = \Auth::user()->id;
        $tarea->save();
        flash('Se a creado la tarea ' . $tarea->name)->success();
        return redirect()->route('proyectos.show',$tarea->proyecto_id);
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
        $tarea = Tarea::find($id);
        return view('admin.tareas.show')->with("tarea",$tarea);
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
        $tarea = Tarea::find($id);
        return view('admin.tareas.edit')->with("tarea",$tarea);
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
        $tarea = Tarea::find($id);
        $tarea->fill($request->all());        
        $tarea->save();
        flash('Se a editado la tarea ' . $tarea->name)->success();

        return redirect()->route('proyectos.show',$tarea->proyecto_id);
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
        $tarea = Tarea::find($id);
        $tarea->delete();
        flash('Se a eliminado la tarea ' . $tarea->name)->error();
        return redirect()->route('proyectos.show',$tarea->proyecto_id);
    }
}
