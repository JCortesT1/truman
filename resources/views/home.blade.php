@extends('layout')

@section('content')
<div class="main-content">
    <div class="row justify-content-end">
        <div class="card col-lg-7">
            <h4 class="card-title"><strong>Libros</strong></h4>

            <div class="card-body">
                <div id="jsgrid-basic" data-provide="jsgrid"></div>
            </div>
        </div>
    </div>
</div>
<!--/.main-content -->
@endsection

@section('script')
    <!-- Sample data to populate jsGrid demo tables -->
    <script src="../assets/data/js/jsgrid-db.js"></script>

    <script>
        app.ready(function(){
            $("#jsgrid-basic").jsGrid({
            height: "550px",
            width: "100%",
            filtering: true,
            inserting:false,
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
                { type: "control", editButton: false, modeSwitchButton: false, deleteButton: false, width: 50,
                    itemTemplate: function(value, item) {
                        var $result = jsGrid.fields.control.prototype.itemTemplate.apply(this, arguments);
                        var $iconBox = $("<i>").attr({class: "fa fa-dropbox"});

                        var $customButton = $("<button>")
                            .append($iconBox)
                            .attr({class: "btn btn-info btn-sm"})
                            .attr({title: "Ver Stock"})
                            .click(function(e) {
                                alert("Stock: " + item.id_producto);
                                e.stopPropagation();
                            });

                        return $result.add($customButton);
                    }
                }
            ]
            });
        });
    </script>
@endsection
