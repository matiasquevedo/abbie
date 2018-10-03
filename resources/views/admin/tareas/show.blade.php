@extends('admin.template.main')


@section('title','Tareas: '.$tarea->name)

@section('content')

	<div class="container">
  		<h3><a href="{{ route('proyectos.show', $tarea->proyecto_id) }}">{{$tarea->proyecto->name}}</a> / {{$tarea->name}}</h3>     
      <h4>Horas de la Tarea</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Fecha</th>
            <th>Horas</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tarea->horas as $hora)
          <tr>
            <td><a href=" {{route('horas.show',$hora->id)}} "> {{$hora->name}}</a></td>
            <td>{{$hora->descripcion}}</td>
            <td>{{$hora->fecha}}</td>
            <td>{{$hora->horas}}</td>
            <td>{{$hora->user->name}}</td>
            <td>
              <a href="{{ route('horas.edit', $hora->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
                </span>
              </a>
              <a href="{{ route('horas.destroy', $hora->id) }}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            </td>
          </tr>
          @endforeach        
        </tbody>
        
      </table>


	</div>
@endsection