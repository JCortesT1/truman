@extends('layout')

@section('content')
@include('partials.status')
<div id="div" class="row">
    <div class="card col-6 mb-0">
        <header class="card-header">
            <h4 class="card-title"><i class="fa fa-inbox fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Caja</strong></h4>
        </header>
        <div id="list" style="height: 500px;" class="media-list media-list-divided media-list-hover overflow-auto">

        </div>
        <footer class="card-footer">
            <div class="row pl-2">
                <div class="col-4 p-0 my-auto">
                    <label>Nr. Lineas:&nbsp;</label><label id="rowsCount">0</label><label>&nbsp;/ Tot. Items:&nbsp;</label><label id="elementsCount">0</label>
                </div>
                <div class="col-5 p-0 my-auto">
                    <select class="form-control" id="document" onchange="changeDocument()">
                    </select>
                </div>
                <div id="div-tax" class="col-3 my-auto p-0 d-none">
                    <div style="text-align: end">
                        <label class="control-label mb-0">Neto: $&nbsp;<label class="control-label mb-0" id="net">0</label></label>
                    </div>
                    <div style="text-align: end">
                        <label class="control-label">Impuesto: $&nbsp;<label class="control-label mb-0" id="tax">0</label></label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end pt-2">
                <div id="div-input-providers" class="col-8 row mr-1 d-none">
                    <div class="col-10 form-type-line form-group px-0 mb-0">
                        <input id="text-provider" class="form-control" type="text" placeholder="Cliente" readonly>
                    </div>
                    <div class="col-1 pl-0">
                        <button id="button-provider" onclick="displayProviders()" class="form-control btn btn-pure btn-info btn-sm pl-0" type="button"><i class="fa fa-search fa-lg"></i></button>
                        <button id="button-empty-provider" onclick="emptyProviders()" class="form-control btn btn-pure btn-danger btn-sm pl-0 d-none" type="button"><i class="fa fa-trash fa-lg"></i></button>
                    </div>
                </div>
                <div style="text-align: end" class="col-1 my-auto pl-0">
                    <h6>Total :</h6>
                </div>
                <div class="col-3 p-0">
                    <div class="d-flex">
                        <input style="text-align: end" class="form-control mb-2" type="number" id="total" value="0" readonly>
                        <button id="button-modal" class="btn btn-pure btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-center-discount" onclick="chargeTotalModalPercent()"><i class="fa fa-pencil fa-2x"></i></button>
                    </div>
                </div>
            </div>
            <div class="row pl-2">
                <div>
                    <button class="btn btn-outline btn-danger btn-sm" onclick="listEmpty()">Cancelar <i class="fa fa-close"></i></button>
                    <button class="btn btn-outline btn-primary btn-sm">Guardar borrador <i class="fa fa-save"></i></button>
                    <button class="btn btn-outline btn-dark btn-sm" onclick="displayUndo()">Devolución <i class="fa fa-undo"></i></button>
                </div>
                <div class="text-right flex-grow">
                    <button class="btn btn-primary btn-sm" onclick="displayPayment()">Pagar <i class="fa fa-check"></i></button>
                </div>
            </div>
        </footer>
    </div>

    @include('home.partials._div_books')
    @include('home.partials._div_payment')
    @include('home.partials._div_providers')
    @include('home.partials._div_undo')

    <div class="modal modal-center fade" id="modal-center-discount" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">Ajusta el total</h5>
                    <button type="button" class="close ml-0" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="btn-group mx-auto">
                            <button id="button-display-percent" class="btn btn-pure btn-warning mx-4" onclick="displayPercent()"><i class="fa fa-percent fa-2x"></i></button>
                            <button id="button-display-manual" class="btn btn-pure btn-primary mx-4" onclick="displayManual()"><i class="fa fa-dollar fa-2x"></i></button>
                        </div>
                    </div>
                    <div id="div-discount-percent">
                        <div class="row mb-4">
                            <div style="text-align: end" class="col-8 my-auto">
                                <h6>Aplica un descuento al total de la venta</h6>
                            </div>
                            <div class="col-3 p-0">
                                <div class="d-flex">
                                    <select id="totalDiscount" class='form-control' onchange="setTotalDiscount(this)">
                                        <option value=0>0 %</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style="text-align: end" class="col-5 my-auto">
                                <h6>Total :</h6>
                            </div>
                            <div class="col-3 p-0">
                                <div class="d-flex">
                                    <input style="text-align: end" class="form-control form-control-lg mb-2" type="number" id="modal-total-percent" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div-discount-manual" class="d-none">
                        <div class="row">
                            <div style="text-align: center" class="col-12 my-auto">
                                <h6>Ajustar precio a:</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center col-12">
                                <div class="p-0">
                                    <input style="text-align: end" class="form-control form-control-lg mb-2" type="number" id="modal-total-manual" min="0" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-primary" onclick="applyDiscount()">Aplicar <i class="fa fa-check"></i></button>
                    <button type="button" class="btn btn-bold btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.main-content -->
@endsection

@section('script')
    <!-- Sample data to populate jsGrid demo tables -->
    <script src="{{ asset('js/jsgrid-books.js') }}"></script>
    <script src="{{ asset('js/jsgrid-tickets.js') }}"></script>
    <script src="{{ asset('js/home.js')}}" defer></script>
    <script src="{{ asset('js/div_payment.js')}}" defer></script>
    <script src="{{ asset('js/div_providers.js')}}" defer></script>
    <script src="{{ asset('js/div_undo.js')}}" defer></script>
@endsection
