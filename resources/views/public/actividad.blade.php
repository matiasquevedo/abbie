@extends('welcome')

@section('title',$actividad->title)
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ route('categories.show',$actividad->category->id)}}">{{$actividad->category->name}}</a></li>
  <li><a href="{{ route('proveedores.show',$actividad->proveedor->id)}}">{{$actividad->title}}</a></li>
</ol>
@endsection
@section('content')
<div class="container">
	<h2> {{$actividad->title}} </h2>
	<h3> {{$actividad->volanta}} </h3>
	<div class="text-justify">
		<p>{!!$actividad->descripcion!!}</p>
	</div><br>

	<div class="text-center">
		<img src="/images/actividades/{{$image}}" height="50%" alt="">
		<div class="row info-actividad">
			@if($actividad->largo == 0)
				<div class="col-lg-12">
					<div class="panel panel-default">
					  <div class="panel-body">
					  	<p><i>Duracion</i></p>
					    <h4><i class="far fa-clock"></i> {{$actividad->duracion}} min</h4>
					  </div>
					</div>
				</div>
			@elseif($actividad->duracion == 0)
				<div class="col-lg-12">
					<div class="panel panel-default">
					  <div class="panel-body">
					  	<p><i>Largo</i></p>
					    <h4><i class="far fa-map"></i></i> {{$actividad->largo}} km</h4>
					  </div>
					</div>
				</div>
			@else
				<div class="col-lg-6">
					<div class="panel panel-default">
					  <div class="panel-body">
					  	<p><i>Largo</i></p>
					    <h4><i class="far fa-map"></i></i> {{$actividad->largo}} km</h4>
					  </div>
					</div>
				</div>
				
				<div class="col-lg-6">
					<div class="panel panel-default">
					  <div class="panel-body">
					  	<p><i>Duracion</i></p>
					    <h4><i class="far fa-clock"></i> {{$actividad->duracion}} min</h4>
					  </div>
					</div>
				</div>
			@endif

		</div>
			
		<div class="text-justify">
			<h4><i>Recomendaciones</i></h4>
			<p>{!!$actividad->recomendacion!!}</p>
		</div><br>

			{!! Form::open(['route'=>['add.cart',], 'method'=>'POST']) !!}

			<div class="row">
	  			<div class="col-md-8">
	  				<div class="row">
	  					<div class="col-md-6" style="display: none">
	  						<div class="form-group">
	  						{!! Form::text('actividad',$actividad->id,['class'=>'form-control','placeholder'=>'Fecha']) !!}
	  						</div>
	  					</div>
	  					<div class="col-md-6">
	  						<div class="form-group date">
	  						{!! Form::label('fecha','Elegir fecha') !!}
	  						{!! Form::text('fecha',null,['class'=>'form-control datetimepicker', 'id'=>'#datetimepicker1','data-provide'=>'datepicker','placeholder'=>'dd/mm/aaaa']) !!}
	  						</div>
	  					</div>
	  					<div class="col-md-6">
	  						<div class="form-group">
	  						{!! Form::label('pasajeros','Adultos (7 años o más)
') !!}
	  						{!! Form::select('pasajeros',config('multiple.adultos'),null,['class'=>'form-control select-category','required']) !!}
	  						</div>
	  					</div>
	  				</div>	
				</div>	

				<div class="col-md-4">	  				
					
					<div class="form-group">
						{!! Form::submit('Agregar al Carrito',['class'=>'btn btn-primary']) !!}
					</div>
				</div>	
			</div>	

			{!! Form::close() !!}

	</div>
	
</div>
@endsection

@section('js')
<script>
          $(function () {
              var date = new Date();
              date.setDate(date.getDate() - 7);

            $('#datetimepicker1').datepicker({
                maxDate: 'now',
                showTodayButton: true,
                showClear: true,
                minDate: date
            });
        });
    </script>
@endsection