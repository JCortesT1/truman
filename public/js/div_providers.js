function setProvider(id, nombre) {
    $("#input-cliente-payment").val(id);
    $("#text-provider").val(nombre);
    $("#button-provider").addClass('d-none');
    $("#button-empty-provider").removeClass('d-none');
    $("#div-books").removeClass('d-none');
    $("#div-providers").addClass('d-none');
}

function cancelProviders() {
    $("#div-providers").addClass('d-none');
    $("#div-books").removeClass('d-none');
}
