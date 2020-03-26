app.ready(function () {
    $("#jsgrid-basic").jsGrid({
        height: "600px",
        width: "100%",
        filtering: true,
        inserting: false,
        editing: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 5,
        controller: db,
        fields: [
            { name: "descripcion", title: "Producto", type: "text", width: 100 },
            { name: "author.nombre", title: "Autor", type: "text", width: 100 },
            { name: "editorial.nombre", title: "Editorial", type: "text", width: 100 },
            { name: "subfamily.family.descripcion", title: "Familia", type: "text", width: 100 },
            { name: "subfamily.descripcion", title: "Subfamilia", type: "text", width: 100 },
            { name: "topic.nombre", title: "Tema", type: "text", width: 100 },
            { name: "precio", title: "Precio", type: "number", width: 70, align: "center" },
            {
                type: "control", editButton: false, modeSwitchButton: false, deleteButton: false, width: 50,
                itemTemplate: function (value, item) {
                    var $result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                    var $iconBox = $("<i>").attr({ class: "fa fa-dropbox" });

                    var $customButton = $("<button>")
                        .append($iconBox)
                        .attr({ class: "btn btn-info btn-sm" })
                        .attr({ title: "Ver Stock" })
                        .click(function (e) {
                            alert("Stock: " + item.id_producto);
                            e.stopPropagation();
                        });

                    return $result.add($customButton);
                }
            }
        ],
        rowClick: function (args) {
            console.log(args.item)
            var element = args.item;
            var keys = Object.keys(element);
            var text = [];

            if ($("#element-" + element.id_producto).length) {
                addQuantity(element);
            } else {
                newElement(element);
            }
        }
    });

    function newElement(element) {
        $('#list').append(
            "<div id='element-" + element.id_producto + "' class='media flexbox flex-justified'>" +
                "<div class='btn-group-vertical'>" +
                    "<button onclick='btnUp(" + element.id_producto + ")' class='btn btn-pure btn-primary p-0'><i class='fa fa-plus-square fa-2x'></i></button>" +
                    "<button onclick='btnDown(" + element.id_producto + ")' class='btn btn-pure btn-primary p-0'><i class='fa fa-minus-square fa-2x'></i></button>" +
                "</div>" +
                "<input class='quantity' type='number' id='quantity-" + element.id_producto + "' value='1' min='1'>" +
                "<div class='my-auto flex-grow-4'>" +
                    "<h5 class'm-0'>" + element.descripcion + "</h5>" +
                    "<p class='m-0'>$/unidad: $ " + element.precio + "</p>" +
                "</div>" +
                "<div class='form-group my-auto'>" +
                    "<select class='form-control' id='select'>" +
                        "<option>1</option>" +
                        "<option>2</option>" +
                        "<option>3</option>" +
                        "<option>4</option>" +
                        "<option>5</option>" +
                    "</select>" +
                "</div>" +
                "<h6 class='my-auto'>$ " + element.precio + "</h6>" +
                "<a class='btn btn-pure btn-danger p-0 my-auto w-50'><i class='fa fa-trash-o fa-2x'></i></a>" +
            "</div>"
        );
    }

    function addQuantity(element) {
        $("#element-" + element.id_producto).find("input").val(function (i, val) {
            return ++val;
        });
    }
});

function btnUp(element) {
    var quantity = "#quantity-" + element;
    $(quantity).val(function (i, val) {
        return ++val;
    });
}

function btnDown(element) {
    var quantity = "#quantity-" + element;
    if ($(quantity).val() > 1)
    {
        $(quantity).val(function (i, val) {
            return --val;
        });
    }
}

