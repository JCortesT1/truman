@extends('layout')

@section('content')
<header class="header bg-ui-general m-0">
    <div class="header-info">
        <h1 class="header-title">
            <strong>Editar Porcentaje</strong>
            <small>Edición de porcentaje para las ventas.</small>
        </h1>
        <div class="my-auto">
            <a class="btn btn-round btn-danger btn-w-md" href="{{ route('percents.index') }}">Volver</a>
        </div>
    </div>
</header>
<!--/.header -->

<div class="main-content my-auto">
    <div class="col-lg-6 mx-auto">
        <form class="card" method="POST" action="{{ route('percents.update', $percent) }}" data-provide="validation"
            data-disable="false">
            <h4 class="card-title"><strong>Editar Porcentaje</strong></h4>
            @method('PATCH')
            @include('percents._form', ['btnText' => 'Actualizar'])
        </form>
    </div>
</div>
@endsection
