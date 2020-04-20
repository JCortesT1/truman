(function () {

    var fullDate = new Date()
    var twoDigitMonth = (((fullDate.getMonth() + 1).toString().length) === 1) ? '0' + (fullDate.getMonth() + 1) : (fullDate.getMonth() + 1);
    var twoDigitDay = fullDate.getDate().toString().length === 1 ? '0' + fullDate.getDate() : fullDate.getDate();
    var currentDate = fullDate.getFullYear() + twoDigitMonth + twoDigitDay;
    console.log(currentDate);

    $.ajax({
        async: false,
        type: "GET",
        url: "getPercents"
    }).done(function (data) {
        percents = data;
    });

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
        url: "documentos"
    }).done(function (data) {
        data.unshift({ id_documento: 0, nombre: "" });
        console.log(data);
        db.documents = data;
    });

    $.ajax({
        async: false,
        type: "GET",
        url: "formasPago"
    }).done(function (data) {
        data.unshift({ id_forma_pago: 0, nombre: "" });
        console.log(data);
        db.payments = data;
    });

    window.db = db;

    $.ajax({
        async: false,
        type: "GET",
        url: "getDocumentsResume/" + currentDate
    }).done(function (data) {
        db.documentsResume = data;
        db.data = data;
        console.log("getDocumentsResume/" + currentDate);
    });
}());
