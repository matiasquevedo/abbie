@extends('admin.template.main')


@section('title','Proyecto: '.$proyecto->name)

@section('content')

	<div class="container">

  		<h3>{{$proyecto->name}}</h3>
      <h4>Total de Horas: {{$proyecto->totaldeHoras}} </h4>
      <h4>Precio/hora: {{$proyecto->precio}} </h4>
      <h4>Costo total: {{$proyecto->precioTotal}} </h4>
  		<a href="{{route('tarea.create',$proyecto->id)}}" class="btn btn-info">Nueva Tarea</a>
  		<a href="{{route('hora.create',$proyecto->id)}}" class="btn btn-info">Agregar Horas</a>
      <div>      	
      @foreach($proyecto->tareas as $tarea)
        <h4> <a href=" {{route('tareas.show', $tarea->id)}} " class="btn btn-success">{{$tarea->name}}</a>
        	<a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
        	  </span>
        	</a>
        	<a href="{{ route('tareas.destroy', $tarea->id) }}" class="btn btn-danger">
        	  <span class="glyphicon glyphicon-remove"></span>
        	</a>
        </h4>
      @endforeach 
      </div>        

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Tarea</th>
            <th>Fecha</th>
            <th>Horas</th>
            <th>Usuario</th>
          </tr>
        </thead>
        <tbody>
          @foreach($horas as $hora)
          <tr>
            <td><a href=" {{route('horas.show',$hora->id)}} "> {{$hora->name}}</a></td>
            <td>{{$hora->descripcion}}</td>
            <td>{{$hora->tarea->name}}</td>
            <td>{{$hora->fecha}}</td>
            <td>{{$hora->horas}}</td>
            <td>{{$hora->user->name}}</td>
            @if(Auth::user()->name == "Matias")
            <td>
              <a href="{{ route('horas.edit', $hora->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
                </span>
              </a>
              <a href="{{ route('horas.destroy', $hora->id) }}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            </td>
            @elseif($hora->user->id == \Auth::user()->id)
            <td>
              <a href="{{ route('horas.edit', $hora->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
                </span>
              </a>
              <a href="{{ route('horas.destroy', $hora->id) }}" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove"></span>
              </a>
            </td>
            @else
              <td></td>
            @endif


          </tr>
          @endforeach        
        </tbody>
        
      </table>
      {{$horas->render()}}


	</div>
@endsection