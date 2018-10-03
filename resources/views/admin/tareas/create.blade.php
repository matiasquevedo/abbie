@extends('admin.template.main')

@section('title','Tarea de Proyecto: '.$proyecto->name)

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
	<h3>Nueva Tarea para el proyecto <i>{{$proyecto->name}}</i>  </h3>

			{!! Form::open(['route'=>'tareas.store', 'method'=>'POST','files'=>'true']) !!}


			<div class="row">
	  			<div class="col-md-8">
					<div class="form-group">
					{!! Form::label('name','Tarea*') !!}
					{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Tarea','required']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('descripcion','Descripción*') !!}
					{!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Descripción','required']) !!}
					</div>

					<div class="form-group" style="display: none !important">
					{!! Form::text('proyecto_id',$proyecto->id,['class'=>'form-control','placeholder'=>'precio','required']) !!}
					</div>
				</div>
			</div>		

			<div class="form-group">
				{!! Form::submit('Crear',['class'=>'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

</div>
@endsection