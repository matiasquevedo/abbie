
@extends('admin.template.main')


@section('title', 'Editar Categoria ' . $category->name)

@section('content')
<div class="container"><br>
	{!! Form::open(['route'=>['categories.update', $category->id], 'method'=>'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name','Categoria') !!}
			{!! Form::text('name',$category->name,['class'=>'form-control','placeholder'=>'Nombre','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
		</div>



	{!! Form::close() !!}
</div>
@endsection