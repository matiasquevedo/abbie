@extends('admin.template.main')

@section('title','Lista de Información')

@section('content')

<div class="row">
  <div class="col-md-1">
    
    <a href="{{ route('informacion.create')}}" class="btn btn-info">Nuevo</a>

  </div>

  <div class="col-md-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Usuario</th>
          <th>Categoria</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach($informaciones as $informacion)
        <tr>
          <td><a href="{{ route('informacion.show', $informacion->id) }}">{{$informacion->title}}</a></td>
          <td>{{$informacion->user->name}}</td>
          <td>{{$informacion->category->name}}</td>
          <td>
            @if($informacion->state == "0")
              <span class="label label-danger">Sin Publicar</span>
            @else
              <span class="label label-success">Publicada</span>
            @endif            
          </td>
          <td>
            <a href="{{ route('informacion.edit', $informacion->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
              </span>
            </a>
            <a href="{{ route('informacion.destroy', $informacion->id) }}" class="btn btn-danger">
              <span class="glyphicon glyphicon-remove"></span>
            </a>
          </td>
        </tr>
        @endforeach        
      </tbody>
      
    </table>
    {{$informaciones->render()}}

  </div>

  <div class="col-md-2">

  </div>

</div>

@endsection
