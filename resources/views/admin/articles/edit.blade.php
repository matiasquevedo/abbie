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
			<h3>Editar la Actividad: {!! $actividad->title !!}</h3>
		</div>

		{!! Form::open(['route'=>['actividades.update',$actividad], 'method'=>'PUT']) !!}

		<div class="row">
  			<div class="col-md-8">
				<div class="form-group">
				{!! Form::label('title','Titulo') !!}
				{!! Form::text('title',$actividad->title,['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('volanta','Volanta*') !!}
				{!! Form::text('volanta',$actividad->volanta,['class'=>'form-control','placeholder'=>'Volanta','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descripcion','Descripción') !!}
				{!! Form::textarea('descripcion',$actividad->descripcion,['class'=>'form-control','id'=>'trumbowyg-demo','placeholder'=>'Contenido','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('recomendacion','Recomendación') !!}
				{!! Form::textarea('recomendacion',$actividad->recomendacion,['class'=>'form-control','id'=>'trumbowyg-demo2','placeholder'=>'Contenido','required']) !!}
				</div>
			</div>


  			<div class="col-md-4">
  				
				<div class="form-group">
				{!! Form::label('category_id','Categoria') !!}
				{!! Form::select('category_id',$categories,$actividad->category->id,['class'=>'form-control select-category','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('precioPublico','Precio al Publico*') !!}
				{!! Form::text('precioPublico',$actividad->precioPublico,['class'=>'form-control ','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descuento','Descuento*') !!}
				{!! Form::text('descuento',$actividad->descuento,['class'=>'form-control','required']) !!}
				</div>


				<div class="form-group">
				{!! Form::label('duracion','Duracion*') !!} <p><i>En Minutos (0 si se desconoce)</i></p>
				{!! Form::text('duracion',$actividad->duracion,['class'=>'form-control','placeholder'=>'Duracion','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('largo','Largo del Recorrido*') !!} <p><i>En Kilometros (0 si se desconoce)</i></p>
				{!! Form::text('largo',$actividad->largo,['class'=>'form-control','placeholder'=>'Largo del Recorrido','required']) !!}
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
		$('#trumbowyg-demo2').trumbowyg();

				document.getElementById("upload").onchange = function() {
					var reader = new FileReader(); //instanciamos el objeto de la api FileReader

		  			reader.onload = function(e) {
		    		document.getElementById("image2").src = e.target.result;
		  			};

		  		// read the image file as a data URL.
		  		reader.readAsDataURL(this.files[0]);
				};

				function limite_textarea(valor) {   
		    		total = valor.length;
		        	document.getElementById('cont').innerHTML = total;
				}

				

	</script>

@endsection