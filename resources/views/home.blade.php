@extends('layout')

@section('content')
<div id="div" class="row">
    <div class="card col-lg-5">
        <header class="card-header">
            <h4 class="card-title"><strong>Caja</strong></h4>
        </header>
        <div id="list" style="height: 600px;" class="media-list media-list-divided media-list-hover overflow-auto">

        </div>
        <footer class="card-footer">
            <div class="row justify-content-end">
                <div style="text-align: end" class="col-3 my-auto">
                    <h6>Total :</h6>
                </div>
                <div class="col-3 p-0">
                    <div class="d-flex">
                        <input style="text-align: end" class="form-control mb-2" type="number" id="total" value="0" readonly>
                        <button class="btn btn-pure btn-primary btn-sm mb-2" onclick="listEmpty()"><i class="fa fa-pencil fa-2x"></i></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <button class="btn btn-outline btn-danger btn-sm" onclick="listEmpty()">Cancelar <i class="fa fa-close"></i></button>
                    <button class="btn btn-outline btn-primary btn-sm">Guardar borrador <i class="fa fa-save"></i></button>
                </div>
                <div class="text-right flex-grow">
                    <button class="btn btn-primary btn-sm">Pagar <i class="fa fa-check"></i></button>
                </div>
            </div>
        </footer>
    </div>
    <div class="card col-lg-7 justify-content-end">
        <h4 class="card-title"><strong>Libros</strong></h4>

        <div class="card-body">
            <div class="overflow-auto" id="jsgrid-basic" data-provide="jsgrid" ></div>
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
