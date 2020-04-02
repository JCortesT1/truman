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
            { name: "topic.nombre", title: "Tema", type: "text", width: 100 },
            { name: "stock_actual", title: "Stock", type: "number", width: 55, align: "center" },
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

    var typeDocument = parseInt($('#document').val());

    if (typeDocument == 3) {
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
                    "<div class='my-auto flex-grow-2'>" +
                        "<h5 class'm-0'>" + element.descripcion + "</h5>" +
                        "<p class='m-0'>$/unidad: $ <strong>" + (precio / 1000).toFixed(3) + "</strong></p>" +
                    "</div>" +
                    "<div class='form-group my-auto'>" +
                        "<select class='form-control' onchange='setDiscount(this, " + element.id_producto + ")'>" +
                            "<option value=0>0 %</option>" +
                        "</select>" +
                    "</div>" +
                    "<h6 class='my-auto'>$ <strong class='unitPrice'>" + (precio / 1000).toFixed(3) + "</strong></h6>" +
                    "<a class='btn btn-pure btn-danger p-0 my-auto mx-0' onclick='deleteElement(" + element.id_producto + ")'><i class='fa fa-trash-o fa-2x'></i></a>" +
                    "<input class='originalPrice' type='hidden' value='" + element.precio + "'>" +
                "</div>";

    $.each(percents, function (index, value) {
        options += "<option value=" + value.percent + ">" + value.percent + " %</option>";
    });

    $('#list').append(
        $(html).hide().fadeIn()
    );

    $('#element-' + element.id_producto).find('select').append(options)

    calculateTotal();
}

function modalStock(element) {
    $('#modal-' + element).click();
}

function setQuantity(element, action) {
    var item = $("#element-" + element);
    var quantity = item.find('.quantity');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - item.find('select').val() / 100;

    if (action === "add") {
        if (quantity.val() < 10) {
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

    item.find('h6').find('strong').text((price * quantity.val()/1000 * discount).toFixed(3));

    calculateTotal();
}

function deleteElement(element) {
    $("#element-" + element).fadeOut("slow", function () {
        $(this).remove();
        calculateTotal();
    });
}

function setDiscount(select, element) {
    var item = $("#element-" + element);
    var quantity = item.find('.quantity');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - select.value / 100;

    item.find('h6').find('strong').text((price * quantity.val() / 1000 * discount).toFixed(3));

    calculateTotal();
}

function calculateTotal() {
    var total = 0;
    var tax = 15.97;
    var elementsCount = 0;

    $('.unitPrice').each(function(index){
        total += $(this).text() * 1000;
    });
    if (parseInt($('#document').val()) == 3) {
        var net = total;
        if (net == 0) {
            $('#net').text(0);
            $('#tax').text(0);
        } else {
            $('#net').text((net / 1000).toFixed(3));
            total = 100 * total / (100 - tax);
            $('#tax').text(((total - net) / 1000).toFixed(3));
        }
    }

    $('.rowElement').each(function (index) {
        elementsCount += parseInt($(this).find('.quantity').val());
    });

    $('#elementsCount').text(elementsCount);
    $('#rowsCount').text($('.rowElement').length);

    $('#total').val(Math.ceil(total));
}

function listEmpty() {

    $('#document').val(1);

    $('#div-tax').addClass('d-none');
    $('#net').text(0);
    $('#tax').text(0);

    $('#list').empty();
    $('#totalDiscount').val(0);
    calculateTotal();
}

function chargeTotalModal() {
    $('#totalModal').val($('#total').val());
}

function setTotalDiscount(select) {
    $('#totalModal').val($('#total').val());
    var totalModal = $('#totalModal').val();
    var discount = 1 - select.value / 100;

    $('#totalModal').val(totalModal * discount);
}

function applyDiscount() {
    var exceedMax = false;
    $('#list').find('select').each(function (index, value) {
        if ((parseInt($(this).val()) + parseInt($('#totalDiscount').val())) > 40) {
            alert('El descuento no puede ser aplicado, supera el máximo autorizado (40 %)');
            exceedMax = true;
            return;
        }
    })

    if (exceedMax) {
        return;
    }

    $('.rowElement').each(function(index, value){
        var selectVal = parseInt($(this).find('select').val());
        var totalDiscount = parseInt($('#totalDiscount').val());
        console.log(selectVal);
        console.log(totalDiscount);
        $(this).find('select').val(selectVal + totalDiscount);
    })

    $('.rowElement').each(function(index, value){
        var quantity = $(this).find('.quantity');
        var price = $(this).find('p').find('strong').text() * 1000;
        var discount = 1 - $('#totalDiscount').val() / 100;

        $(this).find('h6').find('strong').text((price * quantity.val() / 1000 * discount).toFixed(3));
    })

    $('#total').val($('#totalModal').val());
    $('#modal-center-discount .close').click();
    $('#modal-center-discount .close').click();
}

function displayPercent() {
    $('#div-discount-percent').removeClass('d-none');
    $('#div-discount-manual').addClass('d-none');
}

function displayManual() {
    $('#div-discount-percent').addClass('d-none');
    $('#div-discount-manual').removeClass('d-none');
}

function changePrices() {
    var tax = 15.97;
    var precio = 0;

    var typeDocument = parseInt($('#document').val());

    if (typeDocument == 3) {
        $('#div-tax').removeClass('d-none');
        $('.rowElement').each(function(index, value){
            var originalPrice = parseInt($(this).find('.originalPrice').val());
            var selectDiscount = parseInt($(this).find('select').val());
            var discount = 1 - selectDiscount / 100;
            precio = (100 - tax) * originalPrice * discount / 100;
            $(this).find('p strong').text((((100 - tax) * originalPrice / 100) / 1000).toFixed(3));

            var quantity = $(this).find('.quantity').val();
            $(this).find('.unitPrice').text((precio / 1000 * quantity).toFixed(3));
        });
    } else {
        $('#div-tax').addClass('d-none');
        $('.rowElement').each(function (index, value) {
            var originalPrice = parseInt($(this).find('.originalPrice').val());
            var selectDiscount = parseInt($(this).find('select').val());
            var discount = 1 - selectDiscount / 100;
            $(this).find('.unitPrice').text((originalPrice / 1000 * discount).toFixed(3));

            var quantity = $(this).find('.quantity').val();
            $(this).find('p strong').text((originalPrice / 1000 * quantity).toFixed(3));
        });
    }
    calculateTotal();
}

