(function () {
    var currentDate = ($("#input-date").val()).toString().replace(/\-/g, '');
    console.log(currentDate);
    var db = {
        loadData: function (filter) {
            return $.grep(window.db.documentsResume, function (document) {
                return (!filter.orden_venta.document.id_documento || document.orden_venta.document.id_documento === filter.orden_venta.document.id_documento)
                    && (!filter.orden_venta.fecha_documento || document.orden_venta.fecha_documento.toLowerCase().indexOf(filter.orden_venta.fecha_documento.toLowerCase()) > -1)
                    && (filter.orden_venta.numero_documento === undefined || document.orden_venta.numero_documento === filter.orden_venta.numero_documento)
                    && (!filter.forma_pago.id_forma_pago || document.forma_pago.id_forma_pago === filter.forma_pago.id_forma_pago)
                    && (filter.monto === undefined || document.monto === filter.monto);
            });
        },
        insertItem: $.noop,
        updateItem: $.noop,
        deleteItem: $.noop
    }

    $.ajax({
        async: false,
        type: "GET",
        url: "/documentos",
    }).done(function (data) {
        console.log(data);
        data.unshift({ id_documento: 0, nombre: "" });
        db.documents = data;
    });

    $.ajax({
        async: false,
        type: "GET",
        url: "/formasPago"
    }).done(function (data) {
        data.unshift({ id_forma_pago: 0, nombre: "" });
        console.log(data);
        db.payments = data;
    });

    window.db = db;

    $.ajax({
        async: false,
        type: "GET",
        url: "/getDocumentsResume/" + currentDate
    }).done(function (data) {
        db.documentsResume = data;
        db.data = data;
        console.log(data);

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var origin = window.location.origin;
        var options;

        $.each(db.payments, function (index, value) {
            if (value.id_forma_pago != 0) {
                options += "<option value=" + value.id_forma_pago + ">" + value.nombre + "</option>";
            }
        });

        $.each(data, function (index, value) {
            var fecha = value.orden_venta.fecha_documento;
            $("#div").append(
                "<form class='modal-documents' method='POST' action='" + origin + "/updateDocument/" + value.id_detalle_forma_pago + "' >" +
                    "<input type='hidden' name='_token' value='" + CSRF_TOKEN + "'></input>" +
                    "<div>" +
                        "<button id='modal-" + value.id_detalle_forma_pago + "' type='button' class='d-none' data-toggle='modal' data-target='#modal-center-" + value.id_detalle_forma_pago + "'></button>" +
                        "<div class='modal modal-center fade' id='modal-center-" + value.id_detalle_forma_pago + "' tabindex='-1'>" +
                            "<div class='modal-dialog'>" +
                                "<div class='modal-content'>" +
                                    "<div class='modal-header'>" +
                                        "<h3 class='modal-title'>" + value.orden_venta.document.nombre + " N°" + value.orden_venta.numero_documento + "</h4>" +
                                        "<button type='button' class='close' data-dismiss='modal'>" +
                                            "<span aria-hidden='true'>&times;</span>" +
                                        "</button>" +
                                    "</div>" +
                                    "<div class='modal-body mx-3'>" +
                                        "<p class='h4 mb-0'><strong>Fecha:</strong> " + fecha.substring(6, 8) + "/" + fecha.substring(4, 6) + "/" + fecha.substring(0, 4) + " " + fecha.substring(8, 10) + ":" + fecha.substring(10, 12) + "</p>" +
                                        "<div class='row'>" +
                                            "<label class='h4 my-auto col-4 pr-0'><strong>Forma de Pago:</strong></label>" +
                                            "<select id='select-detalle-forma-pago-" + value.id_detalle_forma_pago + "' class='form-control col-7 ml-2' name='forma-pago-nueva'>" +
                                                options +
                                            "</select>" +
                                        "</div>" +
                                        "<p class='h4 mb-0'><strong>Monto:</strong> " + value.monto + "</p>" +
                                    "</div>" +
                                    "<div class='modal-footer'>" +
                                        "<button type='submit' class='btn btn-bold btn-success'>Actualizar</button>" +
                                        "<a class='btn btn-bold btn-danger' data-dismiss='modal'>Cerrar</a>" +
                                    "</div>" +
                                "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</form>"
            );

            $("#select-detalle-forma-pago-" + value.id_detalle_forma_pago).val(value.forma_pago.id_forma_pago);
        });
    });
}());
