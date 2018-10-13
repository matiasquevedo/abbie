@extends('admin.template.main')


@section('title', 'Información: '.$informacion->title)

@section('content')
<div>
  <ol class="breadcrumb">
    <li>Categoria: </li><br>
    <li><a href="{{ route('categories.show',$informacion->category->id)}}">{{$informacion->category->name}}</a></li>
  </ol>
  <div>
    {{$informacion->created_at}}
  </div>

  <div>
    {{$informacion->update_at}}
  </div>
</div>

<div class="container">
  <div class="text-center">
    <div>
      <div class="cambiar-portada">                      
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-edit"></i>
        </button>
      </div>
      <img src="/images/informacion/{{$image}}" width="500">
    </div>
  </div>
    <br>              
    <h3>{{$informacion->title}}</h3>
    @if($informacion->state == '0')
    <div>          
      <h4><span class="badge badge-danger">Sin Publicar</span></h4>
      </span><a class="btn btn-success" href="{{ route('informacion.post',$informacion->id)}}">Publicar</a>
    </div>
    @else
    <div>          
      <h4><span class="badge badge-success">Publicada</span></h4>
      <a class="btn btn-danger" href="{{ route('informacion.undpost',$informacion->id)}}">No Publicar</a>
    </div>
    @endif
    <div class="panel panel-default">
      <div class="panel-body" id="content">     
        <div class="row">
          <div class="col-md-6">
            {!!$informacion->descripcion!!}
          </div>
        </div>                  
      </div>
    </div>
  

</div>

@endsection