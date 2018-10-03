@extends('admin.template.main')


@section('title','Proveedor: '.$proveedor->empresa)

@section('content')


	<div class="container">
      <div>        
        <h3>{{$proveedor->empresa}}</h3>
        <div>
          <p>Responsable: {{$proveedor->name}} </p>
          <p>Email: {{$proveedor->email}} </p>
          <p>Telefono: {{$proveedor->telefono}} </p>
        </div>
      </div>

        <br>
        <h4>Actividades del Proveedor</h4>
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
            @foreach($actividades as $actividad)
            <tr>
              <td><a href="{{ route('actividades.show', $actividad->id) }}">{{$actividad->title}}</a></td>
              <td>{{$actividad->user->name}}</td>
              <td>{{$actividad->category->name}}</td>
              <td>
                @if($actividad->state == "0")
                  <span class="label label-danger">Sin Publicar</span>
                @else
                  <span class="label label-success">Publicada</span>
                @endif            
              </td>
              <td>
                <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-warning">   <span class="glyphicon glyphicon-wrench">          
                  </span>
                </a>
                <a href="{{ route('actividades.destroy', $actividad->id) }}" class="btn btn-danger">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
              </td>
            </tr>
            @endforeach        
          </tbody>
          
        </table>

      </div>

	</div>
@endsection