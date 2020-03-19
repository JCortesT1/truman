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
            <form class="card">
                <h4 class="card-title"><strong>Stacked</strong></h4>

                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
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
