@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('index') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ventas</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('ventas.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nueva
                    Venta</a>
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
                    <h3 class="card-title">Listado de ventas</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_ventas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Agente</th>
                                <th>Cliente</th>
                                <th>Comprobante</th>
                                <th>Condición</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id_venta }}</td>
                                    <td>${{ number_format($venta->total_venta, 2) }}</td>
                                    <td>{{ $venta->fech_venta }}</td>
                                    <td>{{ $venta->usuario->nom_usuario }}</td>
                                    <td>{{ $venta->cliente->nom_cliente }}</td>
                                    <td>{{ $venta->comprobante_venta }}</td>
                                    <td>{{ $venta->condicion_pago_venta }}</td>

                                    @if ($venta->estado_venta == 'Finalizada')
                                        <td><span class="badge bg-success">{{ $venta->estado_venta }}</span></td>
                                    @else
                                        <td><span class="badge bg-danger">{{ $venta->estado_venta }}</span></td>
                                    @endif

                                    <td>
                                        <div class="btn-group">
                                            <a class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='bx bx-dots-vertical-rounded'></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                                <a class="dropdown-item" href="{{ route('ventas.show', $venta) }}">
                                                    <i class='bx bx-receipt'></i> Ver detalle
                                                </a>
                                                <a class="dropdown-item" href="javascript:"
                                                    onclick="cargar_datos_eliminar_venta('{{ $venta->id_venta }}')">
                                                    <i class='bx bx-x-circle'></i> Anular
                                                </a>
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

    <!-- Modal eliminar venta -->
    <div class="modal fade" id="modal_venta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_modal">Anular venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-center" id="descripcion_modal"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_eliminar_venta">Si, anular</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script>
        var input_id_venta = $('#input_id_venta');
        var btn_eliminar_venta = $('#btn_eliminar_venta');
        var nom_venta_label = $('#id_venta');
        const tabla_ventas = $('#tabla_ventas');
        const titulo_modal = $('#titulo_modal');
        const descripcion_modal = $('#descripcion_modal');
        const modal_venta = $('#modal_venta');

        let id_venta = '';
        let accion = '';

        $(document).ready(function() {
            btn_eliminar_venta.on('click', function() {

                var url = '{{ route('ventas.update', ':venta') }}';
                var metodo = 'PUT';

                if (accion === 'eliminar') {
                    metodo = 'DELETE';
                    url = '{{ route('ventas.destroy', ':venta') }}';
                }

                $.ajax({
                    url: url.replace(':venta', id_venta),
                    method: metodo,
                    data: {
                        id_venta: id_venta,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_ventas.DataTable({
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

        function cargar_datos_eliminar_venta(venta) {
            titulo_modal.text('Anular venta');
            descripcion_modal.html('<p class="text-center">¿Está seguro de anular la venta #<strong>' + venta +
                '</strong>?</p>');
            btn_eliminar_venta.html('Si, anular');

            id_venta = venta;
            accion = 'eliminar';
            modal_venta.modal('show');
        }

        function cargar_datos_confirmar_venta(venta) {
            titulo_modal.text('Confirmar venta');
            descripcion_modal.html('<p class="text-center">¿Está seguro de confirmar la recepción de la venta #<strong>' +
                venta + '</strong>?</p>');
            btn_eliminar_venta.html('Si, confirmar');

            id_venta = venta;
            accion = 'confirmar';
            modal_venta.modal('show');
        }
    </script>
@endsection
