@extends('admin.template.main')


@section('title', 'Paquete: '.$paquete->title)

@section('content')
	<div class="container-fluid">
  		<h3>{{$paquete->title}} 
  		@if($paquete->state == '0')
			<span class="label label-danger">Sin Publicar</span>
			<div class="btn btn-default"><a href="{{ route('paquetes.post',$paquete->id)}}">Publicar</a></div>
		@else
			<span class="label label-success">Publicada</span>
			<div class="btn btn-default"><a href="{{ route('paquetes.undpost',$paquete->id)}}">No Publicar</a></div>
  		@endif
  		</h3>

      <div>
      	Precios: <br>
      	Cliente: ${{$paquete->precioCliente}} <br>
      	Costo: ${{$paquete->precioEmpresa}} <br>
      	Descuento: % {{$paquete->descuento}} OFF <br>
      </div>


  		<div class="panel panel-default">
  			<div class="panel-body" id="content">
  				
          		<div class="row">
           			<div class="col-md-6">
              		<h3>Descripción</h3><br>{!!$paquete->descripcion!!}</div>
              		<div class="col-md-6">
              			<h3>Actividades</h3>
                      @foreach($paquete->actividadPaquete as $actividad)
                      <a href="{{ route('actividades.show', $actividad->actividad->id) }}">
                      <h3> {{$actividad->actividad->title}} </h3> </a>

                      @endforeach
              		</div>
          		</div>  				
  			</div>
		</div>
	</div>

@endsection