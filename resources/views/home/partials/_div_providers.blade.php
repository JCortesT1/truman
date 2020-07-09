<div id="div-providers" class="card col-6 mb-0 d-none">
    <header class="card-header">
        <h4 class="card-title"><i class="fa fa-user fa-lg btn-pure btn-primary"></i>&nbsp; <strong>Clientes</strong></h4>
    </header>
    <div style="height: 550px;" class="media-list media-list-divided media-list-hover overflow-auto">
        @foreach ($clientes as $cliente)
            <div class="media">
                <div class="media-body">
                    <h5>
                        <a class="hover-primary" href="#"><strong>{{ $cliente->nombre }}</strong></a>
                    </h5>
                </div>
                <div class="media-right gap-items pr-5">
                    <a class="media-action lead" href="#" onclick="setProvider({{ $cliente->id_cliente_proveedor }}, '{{ $cliente->nombre }}')" data-provide="tooltip" title="Seleccionar" >
                        <i class="fa fa-check fa-lg"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <footer class="card-footer">
        <div class="row pl-2">
            <div class="text-right flex-grow">
                {{-- <button class="btn btn-primary" onclick="">Nuevo <i class="fa fa-check"></i></button> --}}
                <button class="btn btn-primary btn-outline" onclick="cancelProviders()">Cancelar <i class="fa fa-close"></i></button>
            </div>
        </div>
    </footer>
</div>
