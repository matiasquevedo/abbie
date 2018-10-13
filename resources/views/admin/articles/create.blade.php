@extends('admin.template.main')


@section('title', 'Nueva Actividad')

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

	<div class="container"><br>

		<div>
			<h3>Nueva Actividad</h3>
		</div>

		{!! Form::open(['route'=>'actividades.store', 'method'=>'POST','files'=>'true']) !!}


		<div class="row">
  			<div class="col-md-8">
				<div class="form-group">
				{!! Form::label('title','Titulo*') !!}
				{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('volanta','Volanta*') !!}
				{!! Form::text('volanta',null,['class'=>'form-control','placeholder'=>'Volanta','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descripcion','Descripcion*') !!}
				{!! Form::textarea('descripcion',null,['class'=>'form-control','id'=>'trumbowyg-demo','placeholder'=>'Descripcion','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('recomendacion','Recomendaciones*') !!}
				{!! Form::textarea('recomendacion',null,['class'=>'form-control','id'=>'trumbowyg-demo2','placeholder'=>'Recomendaciones','required']) !!}
				</div>
			</div>


  			<div class="col-md-4">
  				
				<div class="form-group">
				{!! Form::label('category_id','Categoria*') !!}
				{!! Form::select('category_id',$categories,null,['class'=>'form-control select-category','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('precioPublico','Precio al Publico*') !!}
				{!! Form::text('precioPublico',null,['class'=>'form-control ','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descuento','Descuento*') !!}
				{!! Form::text('descuento',null,['class'=>'form-control','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('duracion','Duracion*') !!} <p><i>En Minutos (0 si se desconoce)</i></p>
				{!! Form::text('duracion',null,['class'=>'form-control','placeholder'=>'Duracion','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('largo','Largo del Recorrido*') !!} <p><i>En Kilometros (0 si se desconoce)</i></p>
				{!! Form::text('largo',null,['class'=>'form-control','placeholder'=>'Largo del Recorrido','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('image','Imagen de Portada*') !!}
				{!! Form::file('image',['id'=>'upload','name'=>'image']) !!}
				</div>

				<div class="preview">
					<img id="image" width="400" height="400">
				</div>
  			</div>
		</div>		

		<div class="form-group">
			{!! Form::submit('Crear',['class'=>'btn btn-primary']) !!}
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
    		document.getElementById("image").src = e.target.result;
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