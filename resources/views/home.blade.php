@extends('layout')

@section('content')
<div class="row">
    <div class="card col-lg-5">
        <header class="card-header">
            <h4 class="card-title"><strong>Caja</strong></h4>
        </header>
        <div id="list" style="height: 600px;" class="media-list media-list-divided media-list-hover">

        </div>
        <footer class="card-footer flexbox">
            <div>
                <button class="btn btn-outline btn-danger btn-sm">Cancelar <i class="fa fa-close"></i></button>
                <button class="btn btn-outline btn-primary btn-sm">Guardar borrador <i class="fa fa-save"></i></button>
            </div>
            <div class="text-right flex-grow">
                <button class="btn btn-primary btn-sm">Pagar <i class="fa fa-check"></i></button>
            </div>
        </footer>
    </div>
    <div class="card col-lg-7 justify-content-end">
        <h4 class="card-title"><strong>Libros</strong></h4>

        <div class="card-body">
            <div id="jsgrid-basic" data-provide="jsgrid"></div>
        </div>
    </div>
</div>
<!--/.main-content -->
@endsection

@section('script')
    <!-- Sample data to populate jsGrid demo tables -->
    <script src="../assets/data/js/jsgrid-db.js"></script>

    <script src="{{ asset('js/home.js')}}" defer></script>
@endsection
