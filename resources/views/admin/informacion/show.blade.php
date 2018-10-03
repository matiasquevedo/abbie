@extends('admin.template.main')


@section('title', 'Información: '.$informacion->title)

@section('content')
  <div>
    <ol class="breadcrumb">
      <li><a href="{{ route('categories.show',$informacion->category->id)}}">{{$informacion->category->name}}</a></li>
    </ol>
    <div>
      {{$informacion->created_at}}
    </div>

    <div>
      {{$informacion->update_at}}
    </div>
  </div>

	<div class="container-fluid">
  		<h3>{{$informacion->title}} 
  		@if($informacion->state == '0')
			<span class="label label-danger">Sin Publicar</span>
			<div class="btn btn-default"><a href="{{ route('informacion.post',$informacion->id)}}">Publicar</a></div>
		@else
			<span class="label label-success">Publicada</span>
			<div class="btn btn-default"><a href="{{ route('informacion.undpost',$informacion->id)}}">No Publicar</a></div>
  		@endif
  		</h3>

      <div>
      </div>


  		<div class="panel panel-default">
  			<div class="panel-body" id="content">
  				
          <div class="row">
            <div class="col-md-6">
              <h3>Descripción</h3><br>{!!$informacion->descripcion!!}</div>
            <div class="col-md-6">
            </div>
          </div>

  				
  			</div>
		</div>

    <div>
      <div>
        <h4>Imagen de Portada</h4>
      </div>
      <div>
        <img src="/images/informacion/{{$image}}" alt="">
      </div>
    </div>
	</div>
@endsection