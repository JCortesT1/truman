@extends('layout')

@section('content')
<div id="div" class="row">
    <div class="card col-6 mb-0">
        <header class="card-header form-group row">
            <h4 class="col-2 my-auto"><strong>Caja del</strong></h4>
            <div class="col-3">
                <input class="form-control" onchange="getSales(this)" type="date" value="{{ date('Y-m-d') }}">
            </div>
        </header>
        <div style="height: 570px;" class="card-body">
            <div id="sales-resume">
                <div class="border-bottom row m-1">
                    <div class="col-4">
                        <h5><strong>Resumen de Ventas</strong></h5>
                    </div>
                    <div class="col-8 text-right">
                        <h5 id="total-sales-resume"><strong>{{ format_chilean($total_amount) }}</strong></h5>
                    </div>
                </div>
                <div id="div-list-sales" class="row m-3">
                    @forelse ($ventas as $item)
                        <div class="col-5">
                            <h6>{{ $item->nombre }} ({{ $item->count }})</h6>
                        </div>
                        <div class="col-7 text-right">
                            <h6><strong>+ {{ format_chilean($item->suma) }}</strong></h6>
                        </div>
                    @empty
                        <div class="col-4">
                            <h6>Sin Registros</h6>
                        </div>
                    @endforelse
                </div>

            </div>
            <div id="box-resume">

            </div>
        </div>
        <footer class="card-footer">

        </footer>
    </div>
    <div id="div-sale-orders" class="card col-6 justify-content-end mb-0">
        <header class="card-header">
            <h4 class="card-title"><i class="fa fa-file-text fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Resumen de Documentos</strong></h4>
        </header>

        <div class="card-body px-0">
            <div class="overflow-auto" id="jsgrid-basic" data-provide="jsgrid"></div>
        </div>
    </div>
    <div id="div-payment" class="card col-6 justify-content-end mb-0 d-none">

    </div>

</div>
<!--/.main-content -->
@endsection

@section('script')
    <script src="{{ asset('js/jsgrid-sale-orders.js') }}"></script>
    <script src="{{ asset('js/close.js')}}" defer></script>
@endsection
