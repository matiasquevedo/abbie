@extends('admin.template.main')


@section('title', $category->name)

@section('content')
<div class="container">
  <h3>Lista de Articulos con la categoria: {{$category->name}}</h3>    
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Titulo</th>
        <th>Estado</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      @foreach($actividades as $actividad)
        <tr>
          <td> 
            <a href="{{ route('actividades.show', $actividad->id) }}">{{$actividad->title}}</a>
          </td>
          <td>
            @if($actividad->state == "0")
              <h5><span class="badge badge-danger">Sin Publicar</span></h5>
            @else
              <h5><span class="badge badge-success">Publicada</span></h5>
            @endif
          </td>
          <td>
            <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning"><i class="fas fa-wrench"></i>
            </a>
            <a href="{{ route('actividades.destroy', $actividad->id) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
      @endforeach
      
    </tbody>
  </table>




</div>

@endsection
