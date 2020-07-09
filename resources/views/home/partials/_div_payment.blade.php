<div id="div-payment" class="card col-6 justify-content-end mb-0 d-none">
    <form method="POST" action="{{ route('orden_ventas.store') }}" novalidate>
        @csrf
        <header class="card-header">
            <h4 class="card-title"><i class="fa fa-dollar fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Pagar</strong>
            </h4>
        </header>

        <div style="height: 500px;" class="card-body media-list media-list-divided media-list-hover overflow-auto">
            <input type="hidden" name="cliente-payment" id="input-cliente-payment" value=0>
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
                        <input style="text-align: end" class="form-control form-control-lg" type="number"
                            id="payment-method-amount" value=0 min=0>
                    </div>
                </div>
                <div class="row form-group justify-content-end">
                    <a class="btn btn-pure btn-warning mr-4" onclick="addPaymentMethod()" href="#">agregar forma de pago
                        <i class="fa fa-plus"></i></a>
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
                <button id="button-confirmar-pago" type="submit" class="btn btn-primary mr-4" disabled>CONFIRMAR PAGO <i
                        class="fa fa-check"></i></button>
            </div>
        </footer>
        <input type="number" id="partialTotal" class="d-none">
        <div id="div-form-books" class="d-none">

        </div>
    </form>
</div>
