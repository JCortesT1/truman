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
                    var $iconBox = $("<i>").attr({ class: "fa fa-dropbox fa-lg" });

                    var $customButton = $("<button>")
                        .append($iconBox)
                        .attr("class", "btn btn-info btn-sm")
                        .attr("title", "Ver Stock")
                        // .attr("onclick", "modalStock(" + item.id_producto + ")")
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

function getSales(date) {
    var total_amount = 0;
    var fecha = $(date).val().replace(/(-)+/g, '');

    $.ajax({
        async: false,
        type: "GET",
        url: "getDocumentsResume/" + fecha
    }).done(function (data) {
        window.db.documentsResume = data;
        console.log(db);
        $("#jsgrid-basic").jsGrid("option", "data", data);
        console.log($("#jsgrid-basic"));
    });


    $.ajax({
        type: "GET",
        url: "getSales/" + fecha
    }).done(function (data) {
        console.log(data);
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
