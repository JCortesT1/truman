app.ready(function () {

    $("#jsgrid-basic").jsGrid({
        height: "100%",
        width: "100%",
        filtering: true,
        inserting: false,
        editing: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 8,
        pageButtonCount: 5,
        controller: db,
        fields: [
            { name: "descripcion", title: "Producto", type: "text", width: 150 },
            { name: "author.nombre", title: "Autor", type: "text", width: 100 },
            { name: "editorial.nombre", title: "Editorial", type: "text", width: 100 },
            // { name: "subfamily.family.descripcion", title: "Familia", type: "text", width: 100 },
            // { name: "subfamily.descripcion", title: "Subfamilia", type: "text", width: 100 },
            { name: "topic.nombre", title: "Tema", type: "text", width: 90 },
            { name: "stock_actual", title: "Stock", type: "number", width: 60, align: "center" },
            { name: "precio", title: "Precio", type: "number", width: 75, align: "center" },
            {
                type: "control", editButton: false, modeSwitchButton: false, deleteButton: false, width: 60,
                itemTemplate: function (value, item) {
                    var $result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                    var $iconBox = $("<i>").attr({ class: "fa fa-dropbox fa-lg" });

                    var $customButton = $("<button>")
                        .append($iconBox)
                        .attr("class", "btn btn-info btn-sm")
                        .attr("title", "Ver Stock")
                        .attr("onclick", "modalStock(" + item.id_producto + ")")
                        .click(function (e) {
                            e.stopPropagation();
                        });

                    return $result.add($customButton);
                }
            }
        ],
        rowClick: function (args) {
            console.log(args.item)
            console.log(percents);
            var element = args.item;

            if ($("#element-" + element.id_producto).length) {
                setQuantity(element.id_producto, "add");
            } else {
                newElement(element);
            }
        }
    });
});

function newElement(element) {
    var options;
    var tax = 15.97;
    var precio;
    var totalDiscount = 1 - $('#totalDiscount').val() / 100;

    var typeDocument = $('#document').val();

    if (typeDocument == "FE") {
        precio = (100 - tax) * element.precio / 100;
    } else {
        precio = element.precio;
    }

    var html = "<div id='element-" + element.id_producto + "' class='rowElement media flexbox flex-justified'>" +
                    "<div class='btn-group-vertical'>" +
                        "<button onclick='setQuantity(" + element.id_producto + ", &#39;add&#39;)' class='btn btn-pure btn-primary p-0'><i class='fa fa-plus-square fa-2x'></i></button>" +
                        "<button onclick='setQuantity(" + element.id_producto + ", &#39;substract&#39;)' class='btn btn-pure btn-primary p-0'><i class='fa fa-minus-square fa-2x'></i></button>" +
                    "</div>" +
                    "<input class='quantity' type='number' value='1' min='1'>" +
                    "<div class='my-auto flex-grow-3'>" +
                        "<h5 class'm-0'>" + element.descripcion + "</h5>" +
                        "<p class='m-0'>$/unidad: $ <strong>" + (precio / 1000).toFixed(3) + "</strong></p>" +
                    "</div>" +
                    "<div class='form-group my-auto ml-0'>" +
                        "<select class='form-control' onchange='setDiscount(this, " + element.id_producto + ")'>" +
                            "<option value=0>0 %</option>" +
                        "</select>" +
                    "</div>" +
                    "<h6 class='my-auto'>$ <strong class='unitPrice'>" + (precio * totalDiscount / 1000).toFixed(3) + "</strong></h6>" +
                    "<a class='btn btn-pure btn-danger p-0 my-auto mx-0' onclick='deleteElement(" + element.id_producto + ")'><i class='fa fa-trash-o fa-2x'></i></a>" +
                    "<input class='originalPrice' type='hidden' value='" + element.precio + "'>" +
                    "<input class='stock-element' type='hidden' value=" + element.stock_actual + ">" +
                    "<input class='id-element-book' type='hidden' value=" + element.id_producto + ">" +
                "</div>";

    var html_form = "<div id='element-form-book-" + element.id_producto + "' class='d-none'>" +
                        "<input name='id-inventario[]' type='number' class='d-none form-id-inventario' value=" + element.id_inventario + ">" +
                        "<input name='id-producto[]' type='number' class='d-none form-id-producto' value=" + element.id_producto + ">" +
                        "<input name='cantidad[]' type='number' class='d-none form-cantidad' value=1>" +
                        "<input name='precio-unitario[]' type='number' class='d-none form-precio-unitario' value=" + element.precio + ">" +
                        "<input name='total-libro[]' type='number' class='d-none form-total-libro' value=" + element.precio + ">" +
                    "</div>";

    $.each(percents, function (index, value) {
        options += "<option value=" + value.percent + ">" + value.percent + " %</option>";
    });

    $('#list').append(
        $(html).hide().fadeIn()
    );

    $('#div-form-books').append(html_form);

    $('#element-' + element.id_producto).find('select').append(options).val($('#totalDiscount').val());

    calculateTotal();
}

function modalStock(element) {
    $('#modal-' + element).click();
}

function setQuantity(element, action) {
    var item = $("#element-" + element);
    var itemform = $("#element-form-book-" + element);
    var stock = parseInt(item.find('.stock-element').val());
    var quantity = item.find('.quantity');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - item.find('select').val() / 100;

    if (action === "add") {
        if (quantity.val() < stock) {
            quantity.val(function (i, val) {
                return ++val;
            });
        } else {
            alert('No posee stock disponible');
        }
    } else {
        if (quantity.val() > 1) {
            quantity.val(function (i, val) {
                return --val;
            });
        }
    }

    item.find('h6').find('strong').text((price * quantity.val() /1000 * discount).toFixed(3));

    itemform.find('.form-cantidad').val(quantity.val());
    itemform.find('.form-total-libro').val(quantity.val() * price);

    calculateTotal();
}

function deleteElement(element) {
    $("#element-" + element).fadeOut("slow", function () {
        $(this).remove();
        calculateTotal();
    });

    $("#element-form-book-" + element).remove();
}

function setDiscount(select, element) {
    var item = $("#element-" + element);
    var itemform = $("#element-form-book-" + element);
    var quantity = item.find('.quantity');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - select.value / 100;

    item.find('h6').find('strong').text((price * quantity.val() / 1000 * discount).toFixed(3));

    itemform.find('.form-total-libro').val(quantity.val() * price * discount);

    calculateTotal();
}

function calculateTotal() {
    var total = 0;
    var tax = 15.97;
    var elementsCount = 0;

    $('.unitPrice').each(function(index){
        total += $(this).text() * 1000;
    });
    if ($('#document').val() == "FE") {
        var net = total;
        if (net == 0) {
            $('#net').text(0);
            $('#tax').text(0);
            $('#input-total-neto').val(0);
            $('#input-iva').val(0);
        } else {
            if (net.toString().length > 3) {
                $('#net').text((net / 1000).toFixed(3));
            } else {
                $('#net').text(net);
            }
            $('#input-total-neto').val(net);
            total = 100 * total / (100 - tax);
            if ((total - net).toString().length > 3) {
                $('#tax').text(((total - net) / 1000).toFixed(3));
            } else {
                $('#tax').text(total - net);
            }
            $('#input-iva').val(total - net);
        }
    }

    $('.rowElement').each(function (index) {
        elementsCount += parseInt($(this).find('.quantity').val());
    });

    $('#elementsCount').text(elementsCount);
    $('#rowsCount').text($('.rowElement').length);

    $('#total').val(Math.ceil(total));
    $('#payment-method-amount').val(Math.ceil(total));

    if (total.toString().length > 3) {
        $('#label-total-payment').text("$ " + (total / 1000).toFixed(3));
        $('#total-payment').text("$ " + (total / 1000).toFixed(3));
    } else {
        $('#label-total-payment').text("$ " + total);
        $('#total-payment').text("$ " + total);
    }
    $('#input-total-bruto').val(total);
}

function listEmpty() {
    $('#div-payment').addClass('d-none');
    $('#div-books').removeClass('d-none');

    $('#document').val("BOE");
    $('#button-modal').removeClass('btn-warning').addClass('btn-primary');

    $('#div-tax').addClass('d-none');
    $('#net').text(0);
    $('#tax').text(0);

    $('#list').empty();
    $('#totalDiscount').val(0);

    $('#div-payment-method').removeClass('d-none');
    $('#div-paids').empty();
    $('#div-form-books').empty();
    $('#payment-method-amount').val(0);
    $('#total-paid').text("$ 0");
    $('#change-payment').text("$ 0");

    calculateTotal();
    displayPercent();
}

function chargeTotalModalPercent() {
    $('#modal-total-percent').val($('#total').val());
    $('#modal-total-manual').val($('#total').val());
}

function setTotalDiscount(select) {
    $('#modal-total-percent').val($('#total').val());
    var totalModal = $('#modal-total-percent').val();
    var discount = 1 - select.value / 100;

    $('#modal-total-percent').val(totalModal * discount);
    $('#modal-total-manual').val(totalModal * discount);
}

function applyDiscount() {
    var totalDiscount = parseInt($('#totalDiscount').val());
    var porcentDif = $('#modal-total-manual').val() / $('#modal-total-percent').val();
    console.log(porcentDif);

    $('.rowElement').find('select').val(totalDiscount);

    $('.rowElement').each(function(index, value){
        var id_elemento_producto = $(this).find('.id-element-book').val();
        var itemform = $("#element-form-book-" + id_elemento_producto);
        var quantity = $(this).find('.quantity');
        var price = $(this).find('p').find('strong').text() * 1000;
        var discount = 1 - $('#totalDiscount').val() / 100;

        $(this).find('h6').find('strong').text((price * quantity.val() / 1000 * discount * porcentDif).toFixed(3));
        itemform.find('.form-total-libro').val(quantity.val() * price * discount * porcentDif);
    });

    $('#button-modal').removeClass('btn-primary').addClass('btn-warning');

    $('#payment-method-amount').val(Math.ceil($('#modal-total-manual').val()));

    if ($('#modal-total-manual').val().toString().length > 3) {
        $('#label-total-payment').text("$ " + ($('#modal-total-manual').val() / 1000).toFixed(3));
        $('#total-payment').text("$ " + ($('#modal-total-manual').val() / 1000).toFixed(3));
    } else {
        $('#label-total-payment').text("$ " + $('#modal-total-manual').val());
        $('#total-payment').text("$ " + $('#modal-total-manual').val());
    }
    $('#input-total-bruto').val($('#modal-total-manual').val());

    $('#total').val($('#modal-total-manual').val());
    $('#modal-center-discount .close').click();
    $('#modal-center-discount .close').click();
}

function displayPercent() {
    $('#button-display-percent').removeClass('btn-primary').addClass('btn-warning');
    $('#button-display-manual').removeClass('btn-warning').addClass('btn-primary');
    $('#div-discount-percent').removeClass('d-none');
    $('#div-discount-manual').addClass('d-none');
}

function displayManual() {
    $('#button-display-percent').removeClass('btn-warning').addClass('btn-primary');
    $('#button-display-manual').removeClass('btn-primary').addClass('btn-warning');
    $('#div-discount-percent').addClass('d-none');
    $('#div-discount-manual').removeClass('d-none');
}

function changeDocument() {
    var tax = 15.97;
    var precio = 0;

    var typeDocument = $('#document').val();

    if (typeDocument == "FE") {
        $('#div-tax').removeClass('d-none');
        $('.rowElement').each(function(index, value){
            var id_elemento_producto = $(this).find('.id-element-book').val();
            var itemform = $("#element-form-book-" + id_elemento_producto);
            var originalPrice = parseInt($(this).find('.originalPrice').val());
            var selectDiscount = parseInt($(this).find('select').val());
            var discount = 1 - selectDiscount / 100;
            precio = (100 - tax) * originalPrice * discount / 100;
            $(this).find('p strong').text((((100 - tax) * originalPrice / 100) / 1000).toFixed(3));

            itemform.find('.form-precio-unitario').val((100 - tax) * originalPrice / 100);

            var quantity = $(this).find('.quantity').val();
            $(this).find('.unitPrice').text((precio / 1000 * quantity).toFixed(3));

            itemform.find('.form-total-libro').val(precio * quantity);
        });
    } else {
        $('#div-tax').addClass('d-none');
        $('.rowElement').each(function (index, value) {
            var id_elemento_producto = $(this).find('.id-element-book').val();
            var itemform = $("#element-form-book-" + id_elemento_producto);
            var originalPrice = parseInt($(this).find('.originalPrice').val());
            var selectDiscount = parseInt($(this).find('select').val());
            var discount = 1 - selectDiscount / 100;
            var quantity = $(this).find('.quantity').val();
            $(this).find('.unitPrice').text((originalPrice / 1000 * discount * quantity).toFixed(3));

            itemform.find('.form-total-libro').val(precio * quantity);

            var quantity = $(this).find('.quantity').val();
            $(this).find('p strong').text((originalPrice / 1000).toFixed(3));

            itemform.find('.form-precio-unitario').val((100 - tax) * originalPrice / 100);
        });
    }
    $('#label-document').text($('#document option:selected').html());
    $('#input-tipo-documento').text($('#document option:selected').val());
    calculateTotal();
}

function displayPayment() {
    if ($('.rowElement').length == 0) {
        alert('No se ha registrado nada para vender');
        return;
    }

    $('#div-payment').removeClass('d-none');
    $('#div-books').addClass('d-none');

    $('#label-total-payment').text("$ " + ($('#total').val() / 1000).toFixed(3));
    $('#input-total-bruto').val($('#total').val());
    $('#partialTotal').val($('#total').val());
}

function addPaymentMethod() {
    var partialTotal = 0;
    var total = parseInt($('#total').val());
    var payMethodAmountValue = $('#payment-method-amount').val()
    var selectPayMethod = $('#selectPaymentMethod option:selected').html();
    var selectPayMethodValue = $('#selectPaymentMethod option:selected').val();
    var paymentMethodAmountLabel;

    if (payMethodAmountValue.length > 3) {
        paymentMethodAmountLabel = (payMethodAmountValue / 1000).toFixed(3);
    } else {
        paymentMethodAmountLabel = payMethodAmountValue;
    }

    var paymentMethodElement =
        "<div class='w-50 row form-group border-primary border-bottom row-payment-element'>" +
            "<h5 class='col-11 my-auto px-0'>" + selectPayMethod + ": ($ " + paymentMethodAmountLabel + ")</h5>" +
            "<input name='forma-pago[]' type='text' class='d-none' value=" + selectPayMethodValue + ">" +
            "<input name='monto[]' type='number' class='d-none' value=" + payMethodAmountValue + ">" +
            "<div class='col-1 px-0'>" +
                "<a class='btn btn-pure btn-danger mr-4' onclick='removePaymentElement(this)' value='hola' href='#'><i class='fa fa-trash fa-2x'></i></a>" +
            "</div>" +
        "</div>";

    $('#div-paids').append(paymentMethodElement);

    $('.row-payment-element').each(function(index, value){
        partialTotal += parseInt($(this).find('input[type="number"]').val());
    });

    $('#payment-method-amount').val(total - partialTotal);

    if (partialTotal.toString().length > 3) {
        $('#total-paid').text("$ " + (partialTotal / 1000).toFixed(3));
    } else {
        $('#total-paid').text("$ " + partialTotal);
    }
    $('#input-total-pagado').val(partialTotal);

    if (partialTotal > total) {
        var changePayment = partialTotal - total;
        if (changePayment.toString().length > 3) {
            $('#change-payment').text("$ " + (changePayment / 1000).toFixed(3));
        } else {
            $('#change-payment').text("$ " + changePayment);
        }
        $('#input-total-vuelto').val(changePayment);
    }

    if ($('#payment-method-amount').val() <= 0) {
        $('#div-payment-method').addClass('d-none');
        $('#button-confirmar-pago').prop('disabled', false);
    }
}

function removePaymentElement(buttonPaymentElement) {
    var partialTotal = 0;
    var total = parseInt($('#total').val());

    $(buttonPaymentElement).parents('.row-payment-element').remove();

    $('.row-payment-element').each(function (index, value) {
        partialTotal += parseInt($(this).find('input[type="number"]').val());
    });

    $('#payment-method-amount').val(total - partialTotal);

    if (partialTotal.toString().length > 3) {
        $('#total-paid').text("$ " + (partialTotal / 1000).toFixed(3));
    } else {
        $('#total-paid').text("$ " + partialTotal);
    }
    $('#input-total-pagado').val(partialTotal);

    if (partialTotal > total) {
        var changePayment = partialTotal - total;
        if (changePayment.toString().length > 3) {
            $('#change-payment').text("$ " + (changePayment / 1000).toFixed(3));
        } else {
            $('#change-payment').text("$ " + changePayment);
        }
        $('#input-total-vuelto').val(changePayment);
    } else {
        $('#change-payment').text("$ 0");
        $('#input-total-vuelto').val(0);
    }

    if ($('#payment-method-amount').val() <= 0) {
        $('#div-payment-method').addClass('d-none');
        $('#button-confirmar-pago').prop('disabled', false);
    } else {
        $('#div-payment-method').removeClass('d-none');
        $('#button-confirmar-pago').prop('disabled', true);
    }
}

