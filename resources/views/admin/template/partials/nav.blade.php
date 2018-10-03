<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('admin.inicio')}}">
            Sitios WEBS
            <!--<img src="/images/embalsa.png" alt="" width="30px"> --> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="{{ route('users.index')}}">Usuarios<span class="sr-only">(current)</span></a></li>
        <li><a href="{{ route('categories.index')}}">Categorias</a></li>
        <li><a href="{{ route('actividades.index')}}">Actividades</a></li>
        <li><a href="{{ route('admin.eventos.index')}}">Eventos</a></li>
        <li><a href="{{ route('paquetes.index')}}">Paquetes</a></li>
        <li><a href=" {{ route('informacion.index')}} ">Información</a></li>
        <li><a href="">Galeria</a></li>
        <li><a href="{{ route('proveedores.index')}}">Proveedores</a></li>
        <li><a href="{{ route('proyectos.index')}}">Proyectos</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @guest
                            <li><a href="{{ route('login') }}">Login</a></li><!-- 
                            <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li><a href=" {{route('cart.show')}} "><i class="fas fa-shopping-cart"></i></a></li>
                            <li><a href=" {{route('principal')}} ">Pagina Principal</a></li>


                             
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>