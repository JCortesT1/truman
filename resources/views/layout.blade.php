<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="blank, starter">

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
  </head>

  <body class="sidebar-folded">

    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>


    <!-- Sidebar -->
    <aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
      <header class="sidebar-header d-flex justify-content-center">
        <strong>TRUMAN</strong>
      </header>

    <nav class="sidebar-navigation">
        <ul class="menu">
            @auth

                <li class="menu-category">Administración</li>

                <li class="menu-item {{ setActive('home') }}">
                <a class="menu-link" href="{{ route('home') }}">
                    <span class="icon fa fa-home"></span>
                    <span class="title">Dashboard</span>
                </a>
                </li>

                <li class="menu-item {{ setActive('users.*') }}">
                <a class="menu-link" href="{{ route('users.index') }}">
                    <span class="icon fa fa-user"></span>
                    <span class="title">Usuarios</span>
                </a>
                </li>



                <li class="menu-category">Category 2</li>


                <li class="menu-item">
                <a class="menu-link" href="#">
                    <span class="icon ti-layout"></span>
                    <span class="title">Layout</span>
                    <span class="arrow"></span>
                </a>

                <ul class="menu-submenu">
                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="dot"></span>
                        <span class="title">Sidebar</span>
                    </a>
                    </li>

                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="dot"></span>
                        <span class="title">Header</span>
                    </a>
                    </li>

                    <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="dot"></span>
                        <span class="title">Footer</span>
                    </a>
                    </li>
                </ul>
                </li>
            @endauth

        </ul>
      </nav>

    </aside>
    <!-- END Sidebar -->


    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">

        </div>

        <div class="topbar-right">
            <div>
                <a class="btn btn-sm btn-outline btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
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

    @yield('script')


  </body>
</html>
