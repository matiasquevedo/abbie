@extends('admin.template.main')

@section('title','Lista de Información')

@section('content')
<div>
  
  <a href="{{ route('informacion.create')}}" class="btn btn-info">Nuevo</a>

</div>
<div class="container">
  <h4>Lista de Articulos de Información</h4>
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
            <h5><span class="badge badge-danger">Sin Publicar</span></h5>
          @else
            <h5><span class="badge badge-success">Publicada</span></h5>
          @endif             
        </td>
        <td>
          <a href="{{ route('informacion.edit', $informacion->id) }}" class="btn btn-warning"> <i class="fas fa-wrench"></i>
          </a>
          <a href="{{ route('informacion.destroy', $informacion->id) }}" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
      @endforeach        
    </tbody>
    
  </table>
  {{$informaciones->render()}}
  
</div>


@endsection
