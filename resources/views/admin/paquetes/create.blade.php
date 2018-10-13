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

	<div class="container">

		<div>
			<h3>Nuevo Paquete de Actividades</h3>
		</div>

		{!! Form::open(['route'=>'paquetes.store', 'method'=>'POST','files'=>'true']) !!}


		<div class="row">
  			<div class="col-md-8">
				<div class="form-group">
				{!! Form::label('title','Titulo*') !!}
				{!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Titulo','required']) !!}
				</div>


				<div class="form-group">
				{!! Form::label('fechaInicio','Fecha Inicio*') !!}
				{!! Form::date('fechaInicio',null,['class'=>'form-control','placeholder'=>'Fecha Inicio','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('fechaTermino','Fecha Termino*') !!}
				{!! Form::date('fechaTermino',null,['class'=>'form-control','placeholder'=>'Fecha Termino','required']) !!}
				</div>

				<div class="form-group">
				{!! Form::label('descripcion','Descripcion*') !!}
				{!! Form::textarea('descripcion',null,['class'=>'form-control','id'=>'trumbowyg-demo','placeholder'=>'Descripcion','required']) !!}
				</div>

				
			</div>


  			<div class="col-md-4">
  				<div class="form-group">
  				{!! Form::label('actividades','Actividades*') !!}
  				{!! Form::select('actividades[]',$actividades,null,['class'=>'form-control select-tag','multiple']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('precioCliente','Precio al Publico*') !!}
  				{!! Form::text('precioCliente',null,['class'=>'form-control ','required']) !!}
  				</div>

  				<div class="form-group">
  				{!! Form::label('descuento','Descuento*') !!}
  				{!! Form::text('descuento',null,['class'=>'form-control','required']) !!}
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

		$('.select-tag').chosen({
			placeholder_text_multiple:'Seleccione actividades...',
			no_results_text: "Oops, no hay tags parecido a ",
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