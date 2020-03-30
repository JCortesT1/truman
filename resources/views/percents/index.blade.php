@extends('layout')

@section('content')
<header class="header bg-ui-general">
    <div class="header-info">
        <h1 class="header-title">
            <strong>Porcentajes</strong>
            <small>Porcentajes que se aplican en las ventas del sistema.</small>
        </h1>
        <div class="d-flex p-4">
            <a class="btn btn-float btn-primary" title="Agregar Porcentaje" href="{{ route('percents.create') }}"><i
                    class="ti-plus"></i></a>
        </div>
    </div>
</header>
<!--/.header -->
@include('partials.status')

<div class="main-content">
    <div class="card col-6 mx-auto">
        <div class="media-list media-list-divided media-list-hover">
            @foreach ($percents as $percent)
            <div class="media">
                <div class="media-body">
                    <p>
                        <a class="hover-primary" href="#"><strong>{{ $percent->percent }} %</strong></a>
                    </p>
                </div>
                <div class="media-right gap-items">
                    <a class="media-action lead" href="{{ route('percents.edit', $percent) }}" data-provide="tooltip" title="Editar"><i
                        class="fa fa-edit"></i></a>
                    <a class="media-action lead" onclick="document.getElementById('delete-percent-{{ $percent->id }}').submit()" href="#" data-provide="tooltip" title="Eliminar"><i
                        class="fa fa-trash-o"></i></a>
                    <form class="d-none" id="delete-percent-{{ $percent->id }}" method="POST" action="{{ route('percents.destroy', $percent) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                {{ $percents->links() }}
            </ul>
        </nav>
    </div>
</div>
<!--/.main-content -->
@endsection
