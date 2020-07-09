(function () {
    var tickets = {
        loadData: function (filter) {
            return $.grep(this.orders, function (order) {
                return (!filter.document.nombre || order.document.nombre.toLowerCase().indexOf(filter.document.nombre.toLowerCase()) > -1)
                    && (!filter.numero_documento || order.numero_documento.toLowerCase().indexOf(filter.numero_documento.toLowerCase()) > -1)
                    && (filter.total_bruto === undefined || order.total_bruto === filter.total_bruto);
            });
        },
        insertItem: $.noop,
        updateItem: $.noop,
        deleteItem: $.noop
    }

    window.tickets = tickets;

    $.ajax({
        async: false,
        type: "GET",
        url: "orden_ventas"
    }).done(function (data) {
        tickets.orders = data;
    });

    $.ajax({
        async: false,
        type: "GET",
        url: "/documentos",
    }).done(function (data) {
        console.log(data);
        data.unshift({ id_documento: 0, nombre: "" });
        tickets.documents = data;
    });

}());
