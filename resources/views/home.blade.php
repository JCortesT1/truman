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
                <div style="text-align: end" class="col-3 my-auto">
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
                </div>
                <div class="text-right flex-grow">
                    <button class="btn btn-primary btn-sm" onclick="displayPayment()">Pagar <i class="fa fa-check"></i></button>
                </div>
            </div>
        </footer>
    </div>
    <div id="div-books" class="card col-6 justify-content-end mb-0">
        <header class="card-header">
            <h4 class="card-title"><i class="fa fa-book fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Libros</strong></h4>
        </header>

        <div class="card-body px-0">
            <div class="overflow-auto" id="jsgrid-basic" data-provide="jsgrid"></div>
        </div>
    </div>
    <div id="div-payment" class="card col-6 justify-content-end mb-0 d-none">
        <form method="POST" action="{{ route('orden_ventas.store') }}" novalidate>
            @csrf
            <header class="card-header">
                <h4 class="card-title"><i class="fa fa-dollar fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Pagar</strong></h4>
            </header>

            <div style="height: 500px;" class="card-body media-list media-list-divided media-list-hover overflow-auto">
                <div class="row form-group">
                    <h5 id="label-document" class="col-12">Boleta Electrónica</h5>
                    <input id="input-tipo-documento" name="tipo-documento" type="hidden" value="BOE">
                </div>
                <div class="row form-group">
                    <h5 class="col-6 text-right">Fecha de Venta:</h5>
                    <h5 class="col-6">{{ date('d/m/Y') }}</h5>
                </div>
                <div class="row form-group">
                    <h5 class="col-6 text-right">Total a Pagar:</h5>
                    <h5 id="label-total-payment" class="col-6"></h5>
                    <input type="hidden" name="total-bruto" id="input-total-bruto">
                </div>
                <div id="div-payment-method">
                    <div class="row form-group">
                        <select class="form-control col-6 ml-3 mb-4" id="selectPaymentMethod">
                        </select>
                    </div>
                    <div class="row form-group text-right form-type-line">
                        <h5 class="col-6 text-right my-auto">Monto Forma de Pago:</h5>
                        <div class="text-right col-3">
                            <input style="text-align: end" class="form-control form-control-lg" type="number" id="payment-method-amount" value=0 min=0>
                        </div>
                    </div>
                    <div class="row form-group justify-content-end">
                        <a class="btn btn-pure btn-warning mr-4" onclick="addPaymentMethod()" href="#">agregar forma de pago <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div id="div-paids">

                </div>
            </div>
            <footer class="card-footer">
                <div class="row border border-primary rounded-lg p-2 m-2">
                    <div class="col-6 text-right">
                        <h5>Total a Pagar</h5>
                        <h5>Total Pagado</h5>
                        <h5>Vuelto</h5>
                    </div>
                    <div class="col-6 text-right">
                        <h5 id="total-payment"></h5>
                        <h5 id="total-paid">$ 0</h5>
                        <h5 id="change-payment">$ 0</h5>
                        <input type="hidden" name="total-neto" id="input-total-neto">
                        <input type="hidden" name="iva" id="input-iva">
                        <input type="hidden" name="total-pagado" id="input-total-pagado">
                        <input type="hidden" name="total-vuelto" id="input-total-vuelto">
                    </div>
                </div>
                <div class="row form-group justify-content-end">
                    <button id="button-confirmar-pago" type="submit" class="btn btn-primary mr-4" disabled>CONFIRMAR PAGO <i class="fa fa-check"></i></button>
                </div>
            </footer>
            <input type="number" id="partialTotal" class="d-none">
            <div id="div-form-books" class="d-none">

            </div>
        </form>
    </div>
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
    <script src="{{ asset('js/home.js')}}" defer></script>
@endsection
