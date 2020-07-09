function displayPayment() {
    if ($('.rowElement').length == 0) {
        alert('No se ha registrado nada para vender');
        return;
    }

    $('#div-payment').removeClass('d-none');
    $('#div-books').addClass('d-none');

    $('#label-total-payment').text("$ " + formatMoney($('#total').val()));
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

    paymentMethodAmountLabel = formatMoney(payMethodAmountValue);

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

    $('.row-payment-element').each(function (index, value) {
        partialTotal += parseInt($(this).find('input[type="number"]').val());
    });

    $('#payment-method-amount').val(total - partialTotal);

    $('#total-paid').text("$ " + formatMoney(partialTotal));
    $('#input-total-pagado').val(partialTotal);

    if (partialTotal > total) {
        $('#change-payment').text("$ " + formatMoney(partialTotal - total));
        $('#input-total-vuelto').val(partialTotal - total);
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

    $('#total-paid').text("$ " + formatMoney(partialTotal));
    $('#input-total-pagado').val(partialTotal);

    if (partialTotal > total) {
        $('#change-payment').text("$ " + formatMoney(partialTotal - total));
        $('#input-total-vuelto').val(partialTotal - total);
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
