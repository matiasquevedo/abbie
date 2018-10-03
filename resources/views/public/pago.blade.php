@extends('welcome')

@section('title','Pedido n°:'.$pedido->id)

@section('content')
<div class="container">
	<h3>Complete los datos de pago!</h3>
			{!! Form::open(['route'=>['efectuar.pago'], 'method'=>'POST','files'=>'true']) !!}

			<div class="detalle">
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
				  	@foreach($pedido->items as $item)
						
						<tr>
							<td>{{$item['actividad']->title}}</td>
							<td>{{$item['actividad']->precioPublico}}</td>
							<td>{{$item['fecha']}}</td>
							<td>{{$item['cantidad']}} <i>(Adultos)</i> </td>
							<td>${{$item['costo']}}</td>
							<td><a href="{{route('cart.destroy',$item['actividad'])}} " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
						</tr>


				  	@endforeach
				  </tbody>
				</table>
				<div class="text-right">					
					<h4 >Total al Pagar: {{$pedido->precioTotal}} </h4>
				</div>
			</div>


			<div class="row">
	  			<div class="col-md-8">
	  				<h4>Datos Personales</h4>
	  				<div class="form-group" style="display: none !important">
	  				{!! Form::text('pedido',$pedido,['class'=>'form-control ','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('nombre','Nombre*') !!}
	  				{!! Form::text(null,null,['class'=>'form-control ','id'=>'nombreCliente','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('apellido','Apellido*') !!}
	  				{!! Form::text(null,null,['class'=>'form-control ','id'=>'apellidoCliente','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('email','Email*') !!}
	  				{!! Form::text(null,null,['class'=>'form-control ','id'=>'emailTxt','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('tipo_dni','Tipo*') !!}
	  				{!! Form::select(null,config('multiple.tipo'),null,['class'=>'form-control select-category','id'=>'tipoDocCbx','required']) !!}
	  				</div>

					<div class="form-group">
					{!! Form::label('dni','Numero*') !!}
					{!! Form::text(null,null,['class'=>'form-control','id'=>'nroDocTxt','required']) !!}
					</div>
					
					<div class="form-group">
					{!! Form::label('direccion','Direccion*') !!}
					{!! Form::text('direccion',null,['class'=>'form-control ','id'=>'numeroTarjetaTxt','required']) !!}
					</div>

					
				</div>


	  			<div class="col-md-4">
	  				<h4>Datos de la Tarjeta</h4>

	  				<div class="form-group">
	  				{!! Form::label('tipo_dni','Tipo*') !!}
	  				{!! Form::select(null,config('multiple.tipo'),null,['class'=>'form-control select-category','id'=>'formaDePagoCbx','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('tipo_dni','Tipo*') !!}
	  				{!! Form::select(null,$methodPay,null,['class'=>'form-control select-category','id'=>'bancoCbx','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('tarjeta','Numero de Tarjeta*') !!}
	  				{!! Form::text('tarjeta',null,['class'=>'form-control','id'=>'numeroTarjetaTxt','placeholder'=>'Titulo','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('mes','Mes*') !!}
	  				{!! Form::text('mes',null,['class'=>'form-control','id'=>'numeroTarjetaTxt','placeholder'=>'Titulo','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('ano','Año*') !!}
	  				{!! Form::text('ano',null,['class'=>'form-control','id'=>'numeroTarjetaTxt','placeholder'=>'Titulo','required']) !!}
	  				</div>

	  				<div class="form-group">
	  				{!! Form::label('code','Codigo de Seguridad*') !!}
	  				{!! Form::text('code',null,['class'=>'form-control','id'=>'numeroTarjetaTxt','placeholder'=>'Titulo','required']) !!}
	  				</div>
					
					<div class="form-group">
					{!! Form::label('cuotas','Cuotas*') !!}
					{!! Form::select('cuotas',config('multiple.adultos'),null,['class'=>'form-control select-category','id'=>'numeroTarjetaTxt','required']) !!}
					</div>
	  			</div>
			</div>		

			<div class="form-group">
				{!! Form::submit('Pagar: '.$pedido->precioTotal,['class'=>'btn btn-danger']) !!}
			</div>

			{!! Form::close() !!}

			{{$methodPay}}
			@foreach($methodPay as $id)
				{{$id}}
			@endforeach
</div>
@endsection

@section('js')
<script src="https://developers.todopago.com.ar/resources/v2/TPBSAForm.min.js"></script>
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