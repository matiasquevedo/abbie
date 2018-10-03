@extends('admin.template.main')

@section('title', 'Nuevo Proveedor')

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
			<h3>Nuevo Proveedor</h3>
		</div>
		{!! Form::open(['route'=>'proveedores.store', 'method'=>'POST']) !!}
		<div class="row">
			<div class="col-md-8">

				<div class="form-group">
					{!! Form::label('empresa','Empresa') !!}
					{!! Form::text('empresa',null,['class'=>'form-control','placeholder'=>'Empresa','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('name','Responsable') !!}
					{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Responsable','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('email','Email') !!}
					{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email','required']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('telefono','Telefono') !!}
					{!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Telefono','required']) !!}
				</div>


				<div class="form-group">
					{!! Form::submit('Crear',['class'=>'btn btn-primary']) !!}
				</div>
				
			</div>
		</div>
	</div>

	{!! Form::close() !!}


@endsection