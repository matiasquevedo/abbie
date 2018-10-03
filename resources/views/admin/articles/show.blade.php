@extends('admin.template.main')


@section('title','Actividad: '.$actividad->title)

@section('content')
  <div>
    <ol class="breadcrumb">
      <li>Categoria / Proveedor:</li>
      <li><a href="{{ route('categories.show',$actividad->category->id)}}">{{$actividad->category->name}}</a></li>
      <li><a href="{{ route('proveedores.show',$actividad->proveedor->id)}}">{{$actividad->proveedor->empresa}}</a></li>
    </ol>
    <div>
      {{$actividad->created_at}}
    </div>

    <div>
      {{$actividad->update_at}}
    </div>
  </div>

	<div class="container-fluid">
  		<h3>{{$actividad->title}} 
  		@if($actividad->state == '0')
			<span class="label label-danger">Sin Publicar</span>
			<div class="btn btn-default"><a href="{{ route('actividades.post',$actividad->id)}}">Publicar</a></div>
		@else
			<span class="label label-success">Publicada</span>
			<div class="btn btn-default"><a href="{{ route('actividades.undpost',$actividad->id)}}">No Publicar</a></div>
  		@endif
  		</h3>
      <h4>{{$actividad->volanta}}</h4>

      <div>
        <span class="glyphicon glyphicon-hourglass">Duración: {{$actividad->duracion}}m</span> <br>
        <span class="glyphicon glyphicon-map-marker">Largo: {{$actividad->largo}}km</span> 
      </div>
      <div>
        <h4>Precio Proveedor: {{$actividad->precioProveedor}} </h4>
        <h4>Precio Publico: {{$actividad->precioPublico}}   </h4>
        <h4>Descuento: {{$actividad->descuento}}   </h4>
      </div>
  		<div class="panel panel-default">
  			<div class="panel-body" id="content">
  				
          <div class="row">
            <div class="col-md-6">
              <h3>Descripción</h3><br>{!!$actividad->descripcion!!}</div>
            <div class="col-md-6">
              <h3>Recomendaciones</h3><br>{!!$actividad->recomendacion!!}</div>
          </div>

  				<div>
  					<div>
  						<h4>Imagen de Portada</h4>
  					</div>
  					<div>
  						<img src="/images/actividades/{{$image}}" width="500">
  					</div>

  				</div>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                <span class="glyphicon glyphicon-wrench">          
                            </span>
            </button>    				
  			</div>
		</div>
	</div>


  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle"> Nueva Imagen de Portada  <a style="float: right" data-dismiss="modal" class="btn btn-danger" > <i class="glyphicon glyphicon-remove"></i> </a> </h3>


        </div>
        <div class="modal-body">

          <div>
<!-- 
            <form action="{{route('images.update')}}" method="post" enctype="multipart/form-data">
              
              <input type="file" name="image" class="form-control">
              <input type="submit" class="btn btn-primary" value="save">
            </form> -->

            {!! Form::open(['route'=>'images.update', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            {{csrf_field()}}

            <div class="form-group" style="display: none">
            {!!Form::text('actividad_id',$actividad->id,null,['class'=>'form-control','required']) !!}
            </div>


              <div class="form-group">
              {!! Form::label('image','Imagen de Portada*') !!}
              {!! Form::file('image',['id'=>'upload','name'=>'image']) !!}
              </div>

              <div class="preview">
                <img id="image" width="400" height="400">
              </div>

            <div class="form-group">
              {!! Form::submit('Crear',['class'=>'btn btn-primary']) !!}
            </div>



            {!! Form::close() !!} 
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
  <script>

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