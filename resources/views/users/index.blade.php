@extends('layout')

@section('content')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Usuarios</strong>
                <small>Usuarios del sistema Truman.</small>
            </h1>
            <div class="d-flex p-4">
                <a class="btn btn-float btn-primary" title="Agregar Usuario" href="{{ route('users.create') }}"><i class="ti-plus"></i></a>
            </div>
        </div>
    </header>
    <!--/.header -->

    <div class="main-content">
        <div class="card">
            <div class="media-list media-list-divided media-list-hover">
                @foreach ($users as $user)
                    <div class="media">
                        <div class="media-body">
                            <p>
                                <a class="hover-primary" href="#"><strong>{{ $user->nombre }}</strong></a>
                            </p>
                            <p>{{ $user->role->name }}</p>
                        </div>

                        <div class="media-right gap-items">
                            <a class="media-action lead" href="#" data-provide="tooltip" title="Orders"><i class="ti-shopping-cart"></i></a>
                            <a class="media-action lead" href="#" data-provide="tooltip" title="Receipts"><i class="ti-receipt"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    {{ $users->links() }}
                </ul>
            </nav>
        </div>
    </div>
    <!--/.main-content -->
@endsection
