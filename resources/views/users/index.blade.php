@extends('layout')

@section('content')
    <header class="header bg-ui-general">
        <div class="header-info">
            <h1 class="header-title">
                <strong>Usuarios</strong>
                <small>Usuarios del sistema Truman.</small>
            </h1>
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
                                <a class="hover-primary" href="#"><strong>{{ $user->name }}</strong></a>
                            </p>
                            <p>{{ $user->role->name }}</p>
                        </div>

                        <div class="media-right gap-items">
                            <a class="media-action lead" href="#" data-provide="tooltip" title="Orders"><i class="ti-shopping-cart"></i></a>
                            <a class="media-action lead" href="#" data-provide="tooltip" title="Receipts"><i class="ti-receipt"></i></a>
                            <div class="btn-group">
                                <a class="media-action lead" "="" href=" #" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-comments"></i> Messages</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-phone"></i> Call</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-remove"></i> Remove</a>
                                </div>
                            </div>
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
