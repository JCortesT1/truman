<!DOCTYPE html>
<html lang="en" class="custom-scrollbar">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">

    @yield('meta')

    <title>Truman</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/assets/css/core.min.css" rel="stylesheet">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link href="/assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/assets/img/apple-touch-icon.png">
    <link rel="icon" href="/assets/img/favicon.png">

    <script src="{{ asset('js/app.js')}}" defer></script>
  </head>

  <body class="sidebar-folded">
    <div id="app">

        <!-- Preloader -->
        <div class="preloader">
          <div class="spinner-dots">
            <span class="dot1"></span>
            <span class="dot2"></span>
            <span class="dot3"></span>
          </div>
        </div>


        <!-- Sidebar -->
        {{-- <aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
            <header class="sidebar-header">
                <a class="logo-icon" title="Salir" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <span class="logo d-flex justify-content-center">
                    <strong>TRUMAN</strong>
                </span>
            </header>

            <nav class="sidebar-navigation">
                <ul class="menu">
                    @auth

                        <li class="menu-category">Administración</li>

                        <li class="menu-item {{ setActive(['home']) }}">
                        <a class="menu-link" href="{{ route('home') }}">
                            <span class="icon fa fa-home"></span>
                            <span class="title">Punto de Venta</span>
                        </a>
                        </li>

                        @if (auth()->user()->hasRole(['Administrador']))
                            <li class="menu-item {{ setActive(['users.*', 'percents.*']) }} {{ setOpen(['users.*', 'percents.*']) }}">
                                <a class="menu-link" href="#">
                                    <span class="icon fa fa-tv"></span>
                                    <span class="title">Mantenedores</span>
                                    <span class="arrow"></span>
                                </a>

                                <ul class="menu-submenu">
                                    <li class="menu-item {{ setActive(['users.*']) }}">
                                        <a class="menu-link" href="{{ route('users.index') }}" >
                                            <span class="dot"></span>
                                            <span class="title">Usuarios</span>
                                        </a>
                                    </li>

                                    <li class="menu-item {{ setActive(['percents.*']) }}">
                                        <a class="menu-link" href="{{ route('percents.index') }}" >
                                            <span class="dot"></span>
                                            <span class="title">Porcentajes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                    @endauth

                </ul>
            </nav>

        </aside> --}}
        <!-- END Sidebar -->


        <!-- Topbar -->
        <header class="topbar topbar-expand-lg bg-info topbar-inverse">
            <div class="topbar-left">
                <span class="topbar-btn topbar-menu-toggler"><i>&#9776;</i></span>
                <span class="topbar-brand"><strong>TRUMAN</strong></span>

                <div class="topbar-divider d-none d-xl-block"></div>

                <nav class="topbar-navigation">
                    <ul class="menu">

                        <li class="menu-item {{ setActive(['home']) }}">
                            <a class="menu-link" href="#">
                                <span class="icon ti-shopping-cart"></span>
                                <span class="title">POS</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="menu-submenu">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('home') }}">
                                        <span class="title">Punto de Venta</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('orden_ventas.close') }}">
                                        <span class="title">Cierre de Caja</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @if (auth()->user()->hasRole(['Administrador']))
                            <li class="menu-item {{ setActive(['users.*', 'percents.*']) }}">
                                <a class="menu-link" href="#">
                                    <span class="icon ti-layout-grid3-alt"></span>
                                    <span class="title">Mantenedores</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="menu-submenu">
                                    <li class="menu-item">
                                        <a class="menu-link" href="{{ route('users.index') }}">
                                            <span class="title">Usuarios</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a class="menu-link" href="{{ route('percents.index') }}">
                                            <span class="title">Porcentajes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>

            <div class="topbar-right">
                <nav class="topbar-navigation">
                    <ul class="menu">

                        <li class="menu-item">
                            <a class="menu-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icon ti-shift-right"></span>
                                <span class="title">Salir</span>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>



                    </ul>
                </nav>

            </div>
        </header>
        <!-- END Topbar -->


        <!-- Main container -->
        <main class="main-container">
          @yield('content')

          <!-- Footer -->
          <footer class="site-footer">
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <p class="text-center text-md-left">Copyright © {{ date('Y') }} | {{ config('app.name') }}. Todos los derechos reservados.</p>
              </div>

            </div>
          </footer>
          <!-- END Footer -->

        </main>
        <!-- END Main container -->

        <!-- Scripts -->
        <script src="/assets/js/core.min.js"></script>
        <script src="/assets/js/app.min.js"></script>
        <script src="/assets/js/script.min.js"></script>
        <script src="{{ asset('js/utils.js') }}"></script>

        @yield('script')
    </div>


  </body>
</html>
