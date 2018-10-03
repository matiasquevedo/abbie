@extends('admin.template.main')


@section('title','Hora: '.$hora->name)

@section('content')
<div class="container">
	<h3><a href="{{ route('proyectos.show', $hora->proyecto_id) }}">{{$hora->proyecto->name}}</a> / <a href="{{ route('tareas.show', $hora->tarea_id) }}">{{$hora->tarea->name}}</a> / {{$hora->name}}</h3>
	<div>
		<h4>Fecha: {{$hora->fecha}}</h4>
		<h4>Cantidad de horas: {{$hora->horas}}</h4>
		<h4>Usuario: {{$hora->user->name}}</h4>
		<p>{{$hora->descripcion}}</p>
	</div>
</div>

@endsection