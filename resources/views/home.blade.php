@extends('layout')

@section('content')
<div id="div" class="row">
    <div class="card col-lg-6">
        <header class="card-header">
            <h4 class="card-title"><strong>Caja</strong></h4>
        </header>
        <div id="list" style="height: 550px;" class="media-list media-list-divided media-list-hover overflow-auto">

        </div>
        <footer class="card-footer">
            <div class="row pl-2">
                <div class="col-3 p-0 my-auto">
                    <label>Nr. Lineas:&nbsp;</label><label id="rowsCount">0</label><label>&nbsp;/ Tot. Items:&nbsp;</label><label id="elementsCount">0</label>
                </div>
                <div class="col-5 p-0 my-auto">
                    <select class="form-control" id="document" onchange="changePrices()">
                        <option value="1">BOLETA ELECTRÓNICA T</option>
                        <option value="2">BOLETA MANUAL (No válido al SII)</option>
                        <option value="3">FACTURA ELECTRÓNICA T</option>
                    </select>
                </div>
                <div id="div-tax" class="col-4 my-auto p-0 d-none">
                    <div style="text-align: end">
                        <label class="control-label mb-0">Neto: $&nbsp;<label class="control-label mb-0" id="net">0</label></label>
                    </div>
                    <div style="text-align: end">
                        <label class="control-label">Impuesto: $&nbsp;<label class="control-label mb-0" id="tax">0</label></label>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div style="text-align: end" class="col-3 my-auto">
                    <h6>Total :</h6>
                </div>
                <div class="col-3 p-0">
                    <div class="d-flex">
                        <input style="text-align: end" class="form-control mb-2" type="number" id="total" value="0" readonly>
                        <button class="btn btn-pure btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modal-center-discount" onclick="chargeTotalModal()"><i class="fa fa-pencil fa-2x"></i></button>
                    </div>
                </div>
            </div>
            <div class="row pl-2">
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
    <div class="card col-lg-6 justify-content-end">
        <h4 class="card-title"><strong>Libros</strong></h4>

        <div class="card-body">
            <div class="overflow-auto" id="jsgrid-basic" data-provide="jsgrid" ></div>
        </div>
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
                            <button class="form-control btn btn-pure btn-primary mx-4 active" onclick="displayPercent()"><i class="fa fa-percent fa-2x"></i></button>
                            <button class="form-control btn btn-pure btn-primary mx-4" onclick="displayManual()"><i class="fa fa-dollar fa-2x"></i></button>
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
                                    <input style="text-align: end" class="form-control form-control-lg mb-2" type="number" id="totalModal" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div-discount-manual" class="d-none">
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
                                    <input style="text-align: end" class="form-control form-control-lg mb-2" type="number" id="totalModal"
                                        value="0" readonly>
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
    <script src="../assets/data/js/jsgrid-db.js"></script>

    <script src="{{ asset('js/home.js')}}" defer></script>
@endsection
