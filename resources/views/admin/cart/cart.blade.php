@extends('welcome')

@section('title','Carrito')

@section('content')
<div class="container">
	<div class="text-right">		
		<a href=" {{route('cart.trash')}} " class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></a>
	</div>


	 <table class="table ">
	  <thead>
	    <tr>
	      <th>Nombre</th>
	      <th>Precio por Persona</th>
	      <th>Fecha</th>
	      <th>Cantidad</th>
	      <th>SubTotal</th>
	      <th>Acción</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@if(count($cart))
	  	@foreach($cart as $item)
			
			<tr>
				<td>{{$item['actividad']->title}}</td>
				<td>{{$item['actividad']->precioPublico}}</td>
				<td>{{$item['fecha']}}</td>
				<td>{{$item['cantidad']}} <i>(Adultos)</i> </td>
				<td>${{$item['costo']}}</td>
				<td><a href="{{route('cart.destroy',$item['actividad'])}} " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>


	  	@endforeach
	  	@else
	  		<tr>
	  			<td></td>
	  			<td></td>
	  			<td> <p class="text-center"><i>No hay elementos</i></p> </td>
	  			<td></td>
	  			<td></td>
	  		</tr>
	  	@endif
	  </tbody>
	</table>
	@if($total!=0)
		<h4>Total al Pagar: {{$total}} </h4>
		<a href="{{route('pago')}} " class="btn btn-danger">Pagar</span></a></td>
	@endif	
</div>

@endsection