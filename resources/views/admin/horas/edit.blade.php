@extends('admin.template.main')

@section('title','Horas de Proyecto: '.$hora->proyecto->name)

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
	<h3>Editar horas:  <i>{{$hora->id}}</i>, del dia  <i>{{$hora->fecha}}</i> </h3>

			{!! Form::open(['route'=>['horas.update',$hora], 'method'=>'PUT']) !!}

			<div class="row">
	  			<div class="col-md-8">

					<div class="form-group">
					{!! Form::label('tarea_id','Tarea*') !!}
					{!! Form::select('tarea_id',$tareas,null,['class'=>'form-control select-category','required']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('name','Nombre*') !!}
					{!! Form::text('name',$hora->name,['class'=>'form-control','placeholder'=>'Descripción']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('descripcion','Descripción') !!}
					{!! Form::text('descripcion',$hora->descripcion,['class'=>'form-control','placeholder'=>'Descripción']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('fecha','Fecha*') !!}
					{!! Form::date('fecha',$hora->fecha,['class'=>'form-control','placeholder'=>'Fecha']) !!}
					</div>

					<div class="form-group">
					{!! Form::label('horas','Cantidad de Horas*') !!}
					{!! Form::text('horas',$hora->horas,['class'=>'form-control','placeholder'=>'Fecha']) !!}
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