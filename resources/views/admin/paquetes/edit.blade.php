@extends('admin.template.main')


@section('title', 'Editar Actividad')

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
			<h3>Editar el Paquete: {!! $paquete->title !!}</h3>
		</div>

		{!! Form::open(['route'=>['paquetes.update',$paquete], 'method'=>'PUT']) !!}


		<div class="row">
  			<div class="col-md-8">
				<div class="form-group">
				{!! Form::label('title','Titulo*') !!}
				{!! Form::text('title',$paquete->title,['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descripcion','Descripcion*') !!}
				{!! Form::textarea('descripcion',$paquete->descripcion,['class'=>'form-control','id'=>'trumbowyg-demo','placeholder'=>'Descripcion','required']) !!}
				</div>

				
			</div>


  			<div class="col-md-4">


  				<div class="form-group">
  				{!! Form::label('precioCliente','Precio Cliente*') !!}
  				{!! Form::number('precioCliente',$paquete->precioCliente,['class'=>'form-control','placeholder'=>'Precio Cliente','step'=>'any']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('precioEmpresa','Precio Empresa*') !!}
  				{!! Form::number('precioEmpresa',$paquete->precioEmpresa,['class'=>'form-control','placeholder'=>'Precio Empresa','required']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('porcentaje','Porcentaje*') !!}
  				{!! Form::number('porcentaje',$paquete->porcentaje,['class'=>'form-control','placeholder'=>'Porcentaje','required']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('descuento','Descuento*') !!}
  				{!! Form::number('descuento',$paquete->descuento,['class'=>'form-control','placeholder'=>'Descuento','required']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('fechaInicio','Fecha Inicio*') !!}
  				{!! Form::text('fechaInicio',$paquete->fechaInicio,['class'=>'form-control','placeholder'=>'Fecha Inicio','required']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('fechaTermino','Fecha Termino*') !!}
  				{!! Form::text('fechaTermino',$paquete->fechaTermino,['class'=>'form-control','placeholder'=>'Fecha Termino','required']) !!}
  				</div>
  			</div>
		</div>		

		<div class="form-group">
			{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
	

@endsection

@section('js')
	<script>

		$('.select-category').chosen({
			placeholder_text_multiple:'Seleccione al menos 3 tags',
			no_results_text: "Oops, no hay categoria parecida a ",
			search_contains:true,

		});

		$('#trumbowyg-demo').trumbowyg();

	</script>

@endsection