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
        noDataContent: "No se encuentran registros",
        controller: db,
        fields: [
            { name: "orden_venta.document.id_documento", title: "Documento", type: "select", items: db.documents, valueField: "id_documento", textField: "nombre", width: 120, align: "center" },
            {
                name: "orden_venta.fecha_documento", title: "Fecha", type: "text", width: 50, align: "center",
                itemTemplate: function (value) {
                    var fecha = value.substring(value.length, 8);
                    return fecha.substring(0, 2) + ":" + fecha.substring(2, 4);
                },
                filtering: false,
            },
            { name: "orden_venta.numero_documento", title: "Número Documento", type: "number", width: 100, align: "center" },
            { name: "forma_pago.id_forma_pago", title: "Forma Pago", type: "select", items: db.payments, valueField: "id_forma_pago", textField: "nombre", width: 100, align: "center" },
            {
                name: "monto", title: "Monto", type: "number", width: 65, align: "center",
                itemTemplate: function (value) {
                    return "$ " + (value / 1000).toFixed(3);
                }
            },
            {
                type: "control", editButton: false, modeSwitchButton: false, deleteButton: false, width: 50,
                itemTemplate: function (value, item) {
                    var $result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                    var $iconBox = $("<i>").attr({ class: "fa fa-pencil-square fa-lg" });

                    var $customButton = $("<button>")
                        .append($iconBox)
                        .attr("class", "btn btn-warning btn-sm")
                        .attr("title", "Ver Stock")
                        .attr("onclick", "modalDocument(" + item.id_detalle_forma_pago + ")")
                        .click(function (e) {
                            e.stopPropagation();
                        });

                    return $result.add($customButton);
                }
            }
        ],
        rowClick: function (args) {
            console.log(args.item)
            // console.log(percents);
            // var element = args.item;

            // if ($("#element-" + element.id_producto).length) {
            //     setQuantity(element.id_producto, "add");
            // } else {
            //     newElement(element);
            // }
        }
    });
});

function modalDocument(element) {
    $('#modal-' + element).click();
}

function getSales(date) {
    var total_amount = 0;
    var fecha = $(date).val().replace(/(-)+/g, '');

    $.ajax({
        async: false,
        type: "GET",
        url: "getDocumentsResume/" + fecha
    }).done(function (data) {
        window.db.documentsResume = data;
        $("#jsgrid-basic").jsGrid("option", "data", data);

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var origin = window.location.origin;
        $(".modal-documents").remove();

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
                                    "<div class='modal-body mx-4'>" +
                                        "<p class='h4 mb-0'><strong>Fecha:</strong> " + fecha.substring(6, 8) + "/" + fecha.substring(4, 6) + "/" + fecha.substring(0, 4) + " " + fecha.substring(8, 10) + ":" + fecha.substring(10, 12) + "</p>" +
                                        "<p class='h4 mb-0'><strong>Forma de pago:</strong> " + value.forma_pago.nombre + "</p>" +
                                        "<div class='row'>" +
                                            "<label class='h4 mb-0 col-2 pr-0'><strong>Monto:</strong></label>" +
                                            "<input class='form-control col-3 ml-2' min=0 name='monto-nuevo' type='number' value=" + value.monto + " >" +
                                        "</div>" +
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
        });
    });


    $.ajax({
        type: "GET",
        url: "getSales/" + fecha
    }).done(function (data) {
        $("#div-list-sales").empty();

        if (data.length) {
            $.each(data, function (index, value) {
                total_amount += value.suma;
                $("#div-list-sales").append(
                    "<div class='col-5'>" +
                        "<h6>" + value.nombre + " (" + value.count + ")</h6>" +
                    "</div>" +
                    "<div class='col-7 text-right'>" +
                        "<h6><strong>+ $ " + (value.suma / 1000).toFixed(3) + "</strong></h6>" +
                    "</div>"
                );
            });
        } else {
            $("#div-list-sales").append(
                "<div class='col-4'>" +
                    "<h6>Sin Registros</h6>" +
                "</div>"
            );
        }

        if (total_amount != 0) {
            $('#total-sales-resume').find('strong').text("$ " + (total_amount / 1000).toFixed(3));
        } else {
            $('#total-sales-resume').find('strong').text("$ 0");
        }
    });
}
