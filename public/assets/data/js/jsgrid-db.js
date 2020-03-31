(function() {

    var percents;

    $.ajax({
        async: false,
        type: "GET",
        url: "getPercents"
    }).done(function (data) {
        percents = data;
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
    console.log(percents);



    $.ajax({
        async: false,
        type: "GET",
        url: "products"
    }).done(function(data){
        db.products = data;
    });
}());
