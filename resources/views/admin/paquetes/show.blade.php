@extends('admin.template.main')


@section('title', 'Paquete: '.$paquete->title)

@section('content')
<div class="container">
  		<h3>{{$paquete->title}}</h3>
      <h4>${{$paquete->precioCliente}} con {{$paquete->descuento}}% OFF <br></h4>

  		@if($paquete->state == '0')
      <div>          
        <h4><span class="badge badge-danger">Sin Publicar</span></h4>
        </span><a class="btn btn-success" href="{{ route('paquetes.post',$paquete->id)}}">Publicar</a>
      </div>
      @else
      <div>          
        <h4><span class="badge badge-success">Publicada</span></h4>
        <a class="btn btn-danger" href="{{ route('paquetes.post',$paquete->id)}}">No Publicar</a>
      </div>
  		@endif
  		
      <div>
      	Precios: <br>
      	Cliente: ${{$paquete->precioCliente}} <br>
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