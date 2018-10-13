@extends('admin.template.main')


@section('title', 'Lista de Paquetes')

@section('content')

<div class="col-md-1">
  
  <a href="{{ route('paquetes.create')}}" class="btn btn-info">Nuevo</a>

</div>
<div class="container">
  <h4>Lista de Paquetes</h4>
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
            <h5><span class="badge badge-danger">Sin Publicar</span></h5>
          @else
            <h5><span class="badge badge-success">Publicada</span></h5>
          @endif            
        </td>
        <td>
          <a href="{{ route('paquetes.edit', $paquete->id) }}" class="btn btn-warning"><i class="fas fa-wrench"></i>
          </a>
          <a href="{{ route('paquetes.destroy', $paquete->id) }}" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
      </tr>
      @endforeach        
    </tbody>
    
  </table>
  {{$paquetes->render()}}
</div>
@endsection