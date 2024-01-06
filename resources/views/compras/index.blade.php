@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compras</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('compras.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nueva
                    Compra</a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    <!-- Mensaje de éxito luego de guardar un registro -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ROW -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Compras</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_compras">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Agente</th>
                            <th>Comprobante</th>
                            <th>Condición</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($compras as $compra)

                            <tr>
                                <td>{{ $compra->id_compra }}</td>
                                <td>${{ number_format($compra->total_compra, 2) }}</td>
                                <td>{{ $compra->fech_compra }}</td>
                                <td>{{ $compra->proveedor->nom_proveedor }}</td>
                                <td>{{ $compra->usuario->nom_usuario }}</td>
                                <td>{{ $compra->comprobante_compra }}</td>
                                <td>{{ $compra->condicion_pago_compra }}</td>

                                @if ($compra->estado_compra == 'Finalizada')
                                    <td><span class="badge bg-success">{{ $compra->estado_compra }}</span></td>
                                @else
                                    <td><span class="badge bg-danger">{{ $compra->estado_compra }}</span></td>
                                @endif

                                <td>
                                    <div class="btn-group">
                                        <a class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                            <a class="dropdown-item" href="{{ route('compras.show', $compra) }}">
                                                <i class='bx bx-receipt'></i> Ver detalle
                                            </a>
                                            @if ($compra->estado_compra == 'Pendiente')
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="cargar_datos_confirmar_compra('{{ $compra->id_compra }}')">
                                                    <i class='bx bx-check-circle'></i> Confirmar
                                                </a>
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="cargar_datos_eliminar_compra('{{ $compra->id_compra }}')">
                                                    <i class='bx bx-x-circle'></i> Anular
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    <!-- Modal eliminar compra -->
    <div class="modal fade" id="modal_compra" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_modal">Anular compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-center" id="descripcion_modal"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_eliminar_compra">Si, anular</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
    <script>
        var input_id_compra = $('#input_id_compra');
        var btn_eliminar_compra = $('#btn_eliminar_compra');
        var nom_compra_label = $('#id_compra');
        const tabla_compras = $('#tabla_compras');
        const titulo_modal = $('#titulo_modal');
        const descripcion_modal = $('#descripcion_modal');
        const modal_compra = $('#modal_compra');

        let id_compra = '';
        let accion = '';

        $(document).ready(function () {
            btn_eliminar_compra.on('click', function () {

                var url = '{{ route('compras.update', ':compra')  }}';
                var metodo = 'PUT';

                if (accion === 'eliminar') {
                    metodo = 'DELETE';
                    url = '{{ route('compras.destroy', ':compra')  }}';
                }

                $.ajax({
                    url: url.replace(':compra', id_compra),
                    method: metodo,
                    data: {
                        id_compra: id_compra,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_compras.DataTable({
                language: {
                    scrollX: "100%",
                    searchPlaceholder: 'Buscar fecha...',
                    sSearch: '',

                    // Modificar el paginate de next y previous
                    oPaginate: {
                        sNext: '<i class="bx bx-chevron-right"></i>',
                        sPrevious: '<i class="bx bx-chevron-left"></i>'
                    },

                    // Modificar info de cuantos resultados se muestran
                    info: "Mostrando página _PAGE_ de _PAGES_",

                    // Modificar el lengthMenu
                    "lengthMenu": "Mostrar _MENU_ registros",

                    // Modificar el infoEmpty de cuando no hay registros
                    "infoEmpty": "No hay registros disponibles",

                    // Modificar el infoFiltered cuando se filtra
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",

                    noRecordsFound: 'No hay clientes registrados',

                    // Cambiar mensaje No matching records found
                    zeroRecords: "No se encontraron registros coincidentes",

                }
            });
        });

        function cargar_datos_eliminar_compra(compra) {
            titulo_modal.text('Anular compra');
            descripcion_modal.html('<p class="text-center">¿Está seguro de anular la compra #<strong>' + compra + '</strong>?</p>');
            btn_eliminar_compra.html('Si, anular');

            id_compra = compra;
            accion = 'eliminar';
            modal_compra.modal('show');
        }

        function cargar_datos_confirmar_compra(compra) {
            titulo_modal.text('Confirmar compra');
            descripcion_modal.html('<p class="text-center">¿Está seguro de confirmar la recepción de la compra #<strong>' + compra + '</strong>?</p>');
            btn_eliminar_compra.html('Si, confirmar');

            id_compra = compra;
            accion = 'confirmar';
            modal_compra.modal('show');
        }
    </script>

@endsection
