(function() {

    var percents;
    var documents;
    var payMethods;

    $.ajax({
        async: false,
        type: "GET",
        url: "getPercents"
    }).done(function (data) {
        percents = data;
    });

    $.each(percents, function (index, value) {
        $("#totalDiscount").append(
            "<option value=" + value.percent + ">" + value.percent + " %</option>"
        );
    });

    $.ajax({
        async: false,
        type: "GET",
        url: "getDocuments"
    }).done(function (data) {
        documents = data;
    });

    $.each(documents, function (index, value) {
        $("#document").append(
            "<option value='" + value.nombre_corto + "'>" + value.nombre + "</option>"
        );
    });

    $.ajax({
        async: false,
        type: "GET",
        url: "getPayMethods"
    }).done(function (data) {
        payMethods = data;
    });

    $.each(payMethods, function (index, value) {
        $("#selectPaymentMethod").append(
            "<option value=" + value.nombre_corto + ">" + value.nombre + "</option>"
        );
    });

    var db = {
        loadData: function (filter) {
            return $.grep(this.products, function (product) {
                return (!filter.descripcion || product.descripcion.toLowerCase().indexOf(filter.descripcion.toLowerCase()) > -1)
                    && (!filter.author.nombre || product.author.nombre.toLowerCase().indexOf(filter.author.nombre.toLowerCase()) > -1)
                    && (!filter.editorial.nombre || product.editorial.nombre.toLowerCase().indexOf(filter.editorial.nombre.toLowerCase()) > -1)
                    // && (!filter.subfamily.family.descripcion || product.subfamily.family.descripcion.toLowerCase().indexOf(filter.subfamily.family.descripcion.toLowerCase()) > -1)
                    // && (!filter.subfamily.descripcion || product.subfamily.descripcion.toLowerCase().indexOf(filter.subfamily.descripcion.toLowerCase()) > -1)
                    && (!filter.topic.nombre || product.topic.nombre.toLowerCase().indexOf(filter.topic.nombre.toLowerCase()) > -1)
                    && (filter.stock_actual === undefined || product.stock_actual === filter.stock_actual)
                    && (filter.precio === undefined || product.precio === filter.precio);
            });
        },
        insertItem: $.noop,
        updateItem: $.noop,
        deleteItem: $.noop
    }

    window.db = db;
    window.percents = percents;
    window.documents = documents;
    window.payMethods = payMethods;

    $.ajax({
        async: false,
        type: "GET",
        url: "products"
    }).done(function(data){
        db.products = data;
    });

    $.each(db.products, function (index, value) {
        $("#div").append(
            "<button id='modal-" + value.id_producto + "' type='button' class='d-none' data-toggle='modal' data-target='#modal-center-" + value.id_producto + "'></button>" +
            "<div class='modal modal-center fade' id='modal-center-" + value.id_producto + "' tabindex='-1'>" +
                "<div class='modal-dialog'>" +
                    "<div class='modal-content'>" +
                        "<div class='modal-header'>" +
                            "<h4 class='modal-title'>Stock de " + value.descripcion + "</h4>" +
                            "<button type='button' class='close' data-dismiss='modal'>" +
                                "<span aria-hidden='true'>&times;</span>" +
                            "</button>" +
                        "</div>" +
                        "<div class='modal-body mx-auto'>" +
                            "<h6><strong>Stock Firme:</strong> " + value.cellars[0].pivot.stock_actual + "</h6>" +
                            "<h6><strong>Stock Consignatario:</strong> " + value.cellars[1].pivot.stock_actual + "</h6>" +
                        "</div>" +
                        // "<div class='modal-footer'>" +
                        //     "<button type='button' class='btn btn-bold btn-pure btn-secondary' data-dismiss='modal'>Close</button>" +
                        //     "<button type='button' class='btn btn-bold btn-pure btn-primary'>Save changes</button>" +
                        // "</div>" +
                    "</div>" +
                "</div>" +
            "</div>"
        );
    });



}());
