@extends('admin.template.main')


@section('title', 'Lista de Actividades')

@section('content')
<br>
<div class="row">
  <div class="col-md-1">
    
    <a href="{{ route('actividades.create')}}" class="btn btn-info">Nuevo</a>

  </div>

  <div class="col-md-9">
    {!! Form::open(['route'=>'actividades.varios', 'method'=>'GET','files'=>'true']) !!}
    <table class="table table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Titulo</th>
          <th>Usuario</th>
          <th>Categoria</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        {{$actividades}}
        @foreach($actividades as $actividad)
        <tr>
          <td>{{ Form::checkbox('box[]',$actividad->id, null, ['class' => 'field']) }}</td>
          <td><a href="{{ route('actividades.show', $actividad->id) }}">{{$actividad->title}}</a></td>
          <td>{{$actividad->user->name}}</td>
          <td>{{$actividad->category->name}}</td>
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
    {{$actividades->render()}}

  </div>

  <div class="col-md-2">
      <div class="form-group div-fijo">
          {!! Form::label('act','Acción') !!}
          {!! Form::select('act',config('multiple.opciones'),null,['class'=>'form-control','placeholder'=>'Seleccione una opción...','required']) !!}
          {!! Form::submit('Ir',['class'=>'btn btn-primary']) !!}
    </div>
  </div>

</div>
@endsection