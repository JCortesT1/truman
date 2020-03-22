@extends('layout')

@section('content')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Crear Usuario</strong>
                <small>Usuarios del sistema Truman.</small>
            </h1>
            <div class="my-auto">
                <a class="btn btn-round btn-danger btn-w-md" href="{{ route('users.index') }}">Volver</a>
            </div>
        </div>
    </header>
    <!--/.header -->

    <div class="main-content">
        <div class="col-lg-6 mx-auto">
            <form class="card" method="POST" action="{{ route('users.store') }}">
                @csrf
                <h4 class="card-title"><strong>Nuevo Usuario</strong></h4>

                <div class="card-body">
                    <div class="form-group">
                        <label for="rut">Rut</label>
                        <input id="rut" class="form-control" type="text" name="rut">
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control" type="password">
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="password">
                    </div>
                </div>

                <footer class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Login</button>
                </footer>
            </form>
        </div>
    </div>
@endsection
