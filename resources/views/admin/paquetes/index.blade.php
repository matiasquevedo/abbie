@extends('admin.template.main')


@section('title', 'Lista de Paquetes')

@section('content')

<div class="row">
  <div class="col-md-1">
    
    <a href="{{ route('paquetes.create')}}" class="btn btn-info">Nuevo</a>

  </div>

  <div class="col-md-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Usuario</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        @foreach($paquetes as $paquete)
        <tr>
          <td><a href="{{ route('paquetes.show', $paquete->id) }}">{{$paquete->title}}</a></td>
          <td>{{$paquete->user->name}}</td>
          <td>
            @if($paquete->state == "0")
              <span class="label label-danger">Sin Publicar</span>
            @else
              <span class="label label-success">Publicada</span>
            @endif            
          </td>
          <td>
            <a href="{{ route('paquetes.edit', $paquete->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
              </span>
            </a>
            <a href="{{ route('paquetes.destroy', $paquete->id) }}" class="btn btn-danger">
              <span class="glyphicon glyphicon-remove"></span>
            </a>
          </td>
        </tr>
        @endforeach        
      </tbody>
      
    </table>
    {{$paquetes->render()}}

  </div>

  <div class="col-md-2">

  </div>

</div>
@endsection