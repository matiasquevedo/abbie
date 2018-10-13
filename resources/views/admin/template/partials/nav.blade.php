<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('admin.inicio')}}">
            {{env('APP_NAME')}}
            <!--<img src="/images/embalsa.png" alt="" width="30px"> --> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('users.index')}}">&nbsp;<span class="sr-only">(current)</span></a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('users.index')}}">Usuarios<span class="sr-only">(current)</span></a></li>        
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actividades</span></a>          
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('categories.index')}}">Categorias</a>
            <a class="dropdown-item" href="{{ route('actividades.index')}}">Actividades</a>
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="{{ route('paquetes.index')}}">Paquetes de Actividades</a>
          </div>
        </li> 
        <li class="nav-item"><a class="nav-link" href=" {{ route('informacion.index')}} ">Información</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.eventos.index')}}">Eventos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('proyectos.index')}}">Proyectos</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fotos</span></a>          
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('albumes.index')}}">Fotos</a>
            <a class="dropdown-item" href="{{ route('albumes.create')}}">Nuevo Album</a>
          </div>
        </li>


        

      </ul>
      <ul class="nav navbar-nav navbar-right">
        @guest
                            <li><a href="{{ route('login') }}">Login</a></li><!-- 
                            <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li class="nav-item"><a class="nav-link" href=" {{route('cart.show')}} "><i class="fas fa-shopping-cart"></i></a></li>
                            <li class="nav-item"><a class="nav-link" href=" {{route('principal')}} ">Pagina Principal</a></li>

                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</span></a>          
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->type == "admin")
                                    <a class="dropdown-item" href="{{route('admin.inicio')}}">Mi Perfil</a>
                                @else                                    
                                   <a class="dropdown-item" href="{{route('editor.inicio')}}">Mi Perfil</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                              </div>
                            </li>
                        @endguest
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>