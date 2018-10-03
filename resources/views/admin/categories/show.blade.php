@extends('admin.template.main')


@section('title', $category->name)

@section('content')
<div class="row">
    <div class="col-md-1">
    
    </div>
    <div class="col-md-10">
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
            <td> <a href="{{ route('actividades.show', $actividad->id) }}">{{$actividad->title}}</a></td>
            <td>
        @if($actividad->state == "0")
          <span class="label label-danger">Sin Publicar</span>
        @else
          <span class="label label-success">Publicada</span>
        @endif

      </td>
      <td><a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
            <a href="{{ route('actividades.destroy', $actividad->id) }}" class="btn btn-danger">
              <span class="glyphicon glyphicon-remove"></span>
            </a>
      </td>



          </tr>

        @endforeach
        
      </tbody>
    </table>



  </div>
  <div class="col-md-1">
  </div>
</div>

@endsection
