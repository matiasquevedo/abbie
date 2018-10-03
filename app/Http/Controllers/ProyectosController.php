<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Hora;
use Laracasts\Flash\Flash;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $horas = Hora::latest()->take(5)->get();
        //dd($horas);
        $proyectos = Proyecto::orderBy('created_at','ASC')->paginate(20);
        return view('admin.proyectos.index')->with('proyectos', $proyectos)->with('horas', $horas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.proyectos.create');
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
        $proyecto = new Proyecto($request->all());
        $proyecto->totaldeHoras = '0';
        $proyecto->precioTotal = '0';
        $proyecto->save();
        flash('Se a creado el proyecto ' . $proyecto->name)->success();
        return redirect()->route('proyectos.index');
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
        $proyecto = Proyecto::find($id);
        $horas = Hora::all()->where('proyecto_id',$id);
        return view('admin.proyectos.show')->with('proyecto',$proyecto)->with('horas',$horas);
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
        $proyecto = Proyecto::find($id);
        return view('admin.proyectos.edit')->with('proyecto',$proyecto);
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
        $proyecto = Proyecto::find($id);
        $proyecto->fill($request->all());
        $proyecto->precioTotal=$proyecto->totaldeHoras*$request->precio;
        $proyecto->save();
        flash('Se a editado el proyecto ' . $proyecto->name)->success();
        return redirect()->route('proyectos.index');
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
        $proyecto = Proyecto::find($id);
        $proyecto->delete();
        flash('Se a eliminado el proyecto ' . $proyecto->name)->error();
        return redirect()->route('proyectos.index');
    }
}
