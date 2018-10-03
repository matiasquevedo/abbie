@extends('admin.template.main')

@section('title', 'Lista de Proveedores')

@section('content')

<div class="row">
  <div class="col-md-1">
    
    <a href="{{ route('proveedores.create')}}" class="btn btn-info">Nuevo</a>

  </div>

  <div class="col-md-9">
      		<table class="table table-striped">
  <thead>
    <tr>
      <th>Empresa</th>
      <th>Responsable</th>
      <th>Email</th>
      <th>Telefono</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($proveedores as $proveedor)
		<tr>
			<td><a href="{{ route('proveedores.show', $proveedor->id) }}">{{$proveedor->empresa}}</a></td>
			<td>{{$proveedor->name}}</td>
			<td>{{$proveedor->email}}</td>
			<td>{{$proveedor->telefono}}</td>
			<td><a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a><a href="{{ route('proveedores.destroy', $proveedor->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>


  	@endforeach
  
  </tbody>
</table>
{!! $proveedores->render() !!} 

  </div>

  <div class="col-md-2">

  </div>

</div>
@endsection