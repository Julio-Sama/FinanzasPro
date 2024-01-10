<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{url('index')}}">
                <img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img main-logo"
                     alt="Sparic logo">
                <img src="{{asset('build/assets/images/brand/logo-light.png')}}" class="header-brand-img darklogo"
                     alt="Sparic logo">
                <img src="{{asset('build/assets/images/brand/icon.png')}}" class="header-brand-img icon-logo"
                     alt="Sparic logo">
                <img src="{{asset('build/assets/images/brand/icon2.png')}}" class="header-brand-img icon-logo2"
                     alt="Sparic logo">
            </a>
        </div>
        <!-- logo-->
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
                </svg>
            </div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{url('index')}}"><i
                            class="side-menu__icon bx bx-home"></i><span
                            class="side-menu__label">Inicio</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('clientes.index') }}"><i
                            class="side-menu__icon bx bx-user"></i><span
                            class="side-menu__label">Clientes</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('proveedores.index') }}"><i
                            class="side-menu__icon bx bx-store-alt"></i><span
                            class="side-menu__label">Proveedores</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon bx bx-box"></i><span
                            class="side-menu__label">Inventario</span><i
                            class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="panel sidetab-menu">
                            <div class="">
                                <ul>
                                    <li><a href="{{ route('categorias.index') }}" class="slide-item"> Categorias</a></li>
                                    <li><a href="{{ route('productos.index') }}" class="slide-item"> Productos</a></li>
                                    <li><a href="{{ route('kardex.index') }}" class="slide-item"> Kardex</a></li>


                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('compras.index') }}"><i
                            class="side-menu__icon bx bx-cart"></i><span
                            class="side-menu__label">Compras</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('ventas.index') }}"><i
                            class="side-menu__icon bx bx-file"></i><span
                            class="side-menu__label">Ventas</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon bx bx-buildings"></i><span
                            class="side-menu__label">Activo fijo</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon bx bx-group"></i><span
                            class="side-menu__label">Usuarios</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                     width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
