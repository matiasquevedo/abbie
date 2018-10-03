         <nav class="navbar navbar-default navbar-static-top" >
            <div class="container">
                <div class="navbar-header">

                    <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Actividades</a></li>
                            @foreach($categories as $category)
                            <li><a href="#">{{$category->name}}</a></li> 
                            @endforeach
                    </ul> 
                    

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images/embalsa.png" alt="" width="30px">
                    </a>


                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    
                    <ul class="nav navbar-nav navbar-right">
                        
                        @guest
                            <li><a href="{{ route('login') }}">Inciar Sesion</a></li> 
                            <li><a href="{{ route('register') }}">Registrarse</a></li> 
                        @else
                            <li>
                            @if(count(\Session::get('cart', array())))
                                <a href=" {{route('cart.show')}} ">
                                    <i class="fas fa-shopping-cart">
                                        
                                    </i>
                                    <span class="badge badge-notify">{{count(\Session::get('cart', array())) }}</span>
                                </a>
                            @else
                                <a href=" {{route('cart.show')}} ">
                                    <i class="fas fa-shopping-cart cart-black" style="color:gray;">
                                        
                                    </i>
                                    <span class="badge badge-notify" style="background-color: grey;">{{count(\Session::get('cart', array())) }}</span>
                                </a>                                
                            @endif
                            </li> 

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->type == "admin")
                                        <li><a href="{{route('admin.inicio')}}">Mi Perfil</a></li>
                                    @else                                    
                                        <li><a href="{{route('editor.inicio')}}">Mi Perfil</a></li>
                                    @endif
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
                </div>
            </div>
        </nav>
