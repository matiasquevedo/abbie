@extends('admin.template.main')

@section('title','Editar tarea: '.$tarea->name)

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
	<h3>Editar Tarea <i>{{$tarea->name}}</i>  </h3>

			{!! Form::open(['route'=>['tareas.update',$tarea], 'method'=>'PUT']) !!}


			<div class="row">
	  			<div class="col-md-8">
					<div class="form-group">
					{!! Form::label('name','Tarea*') !!}
					{!! Form::text('name',$tarea->name,['class'=>'form-control','placeholder'=>'Tarea','required']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('descripcion','Descripción*') !!}
					{!! Form::text('descripcion',$tarea->descripcion,['class'=>'form-control','placeholder'=>'Descripción','required']) !!}
					</div>
				</div>
			</div>		

			<div class="form-group">
				{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
			</div>

			{!! Form::close() !!}

</div>
@endsection