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
            { name: "stock_actual", title: "Stock", type: "number", width: 70, align: "center" },
            { name: "precio", title: "Precio", type: "number", width: 70, align: "center" },
            {
                type: "control", editButton: false, modeSwitchButton: false, deleteButton: false, width: 50,
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
    var part1 = "<div id='element-" + element.id_producto + "' class='media flexbox flex-justified'>" +
                    "<div class='btn-group-vertical'>" +
                        "<button onclick='setQuantity(" + element.id_producto + ", &#39;add&#39;)' class='btn btn-pure btn-primary p-0'><i class='fa fa-plus-square fa-2x'></i></button>" +
                        "<button onclick='setQuantity(" + element.id_producto + ", &#39;substract&#39;)' class='btn btn-pure btn-primary p-0'><i class='fa fa-minus-square fa-2x'></i></button>" +
                    "</div>" +
                    "<input class='quantity' type='number' value='1' min='1'>" +
                    "<div class='my-auto flex-grow-2'>" +
                        "<h5 class'm-0'>" + element.descripcion + "</h5>" +
                        "<p class='m-0'>$/unidad: $ <strong>" + (element.precio / 1000).toFixed(3) + "</strong></p>" +
                    "</div>" +
                    "<div class='form-group my-auto'>";

    var select = "<select class='form-control' onchange='setDiscount(this, " + element.id_producto + ")'>" +
                    "<option value='0'>0 %</option>";

    $.each(percents, function (index, value) {
        select += "<option value='" + value.percent + "'>" + value.percent + " %</option>";
    });

    select += "</select>"

    var part2 = "</div>" +
                    "<h6 class='my-auto'>$ <strong>" + (element.precio / 1000).toFixed(3) + "</strong></h6>" +
                    "<a class='btn btn-pure btn-danger p-0 my-auto mx-0' onclick='deleteElement(" + element.id_producto + ")'><i class='fa fa-trash-o fa-2x'></i></a>" +
                "</div>";

    $('#list').append(
        $(part1 + select + part2).hide().fadeIn()
    );

    calculateTotal();
}

function modalStock(element) {
    $('#modal-' + element).click();
}

function setQuantity(element, action) {
    var item = $("#element-" + element);
    var quantity = item.find('input');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - item.find('select').children('option:selected').val() / 100;

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
    var quantity = item.find('input');
    var price = item.find('p').find('strong').text() * 1000;
    var discount = 1 - select.value / 100;

    item.find('h6').find('strong').text((price * quantity.val() / 1000 * discount).toFixed(3));

    calculateTotal();
}

function calculateTotal() {
    var total = 0;

    $('h6').find('strong').each(function(index){
        console.log($(this).text() * 1000);
        total += $(this).text() * 1000;
    });

    $('#total').val(total);
}

function listEmpty() {
    $('#list').empty();
    calculateTotal();
}

