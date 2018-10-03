@extends('admin.template.main')

@section('title', 'Editar Proveedor: '.$proveedor->empresa)

@section('content')
	
	@if(count($errors)>0)

		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)

					<li>
						{{ $error}}
					</li>

				@endforeach
			</ul>
			

		</div>
		
	@endif

	<div class="container">
		<div>
			<h3>Editar Proveedor: {{$proveedor->empresa}} </h3>
		</div>
		{!! Form::open(['route'=>['proveedores.update', $proveedor->id], 'method'=>'PUT']) !!}
		<div class="row">
			<div class="col-md-8">

				<div class="form-group">
					{!! Form::label('empresa','Empresa') !!}
					{!! Form::text('empresa',$proveedor->empresa,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('name','Responsable') !!}
					{!! Form::text('name',$proveedor->name,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('email','Email') !!}
					{!! Form::text('email',$proveedor->email,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('telefono','Telefono') !!}
					{!! Form::text('telefono',$proveedor->telefono,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
				</div>


				<div class="form-group">
					{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
				</div>
				
			</div>
		</div>
	</div>

	{!! Form::close() !!}


@endsection