@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{ url('index') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Activos</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('activos.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nuevo
                    Activo</a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    {{-- Mensaje de éxito luego de guardar un registro --}}
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
                    <h3 class="card-title">Listado de activos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_activos">
                        <thead>
                            <tr>
                                <th>COD.</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Fecha de adquisición</th>
                                <th>Vida útil</th>
                                <th>Valor de adquisición</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activos as $activo)
                                <tr>
                                    <td>{{ $activo->cod_activo }}</td>
                                    <td>{{ $activo->tipo->nom_tipo }}</td>
                                    <td>{{ $activo->descrip_activo }}</td>
                                    <td>{{ $activo->fech_compra_activo }}</td>
                                    <td>{{ $activo->tipo->vida_util }} años</td>
                                    <td>${{ $activo->costo_compra_activo }} </td>

                                    @if ($activo->estado_activo == 'USANDO')
                                        <td><span class="badge bg-success">{{ $activo->estado_activo }}</span></td>
                                    @else
                                        <td><span class="badge bg-danger">{{ $activo->estado_activo }}</span></td>
                                    @endif

                                    <td>
                                        <div class="btn-group">
                                            <a class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="bx bx-dots-vertical-rounded"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                                <a href="{{ route('activos.show', $activo) }}" class="dropdown-item">
                                                    <i class="bx bx-receipt"></i>Ver información
                                                </a>
                                                <a href="{{ route('activos.edit', $activo) }}" class="dropdown-item">
                                                    <i class="bx bx-pencil"></i>Editar
                                                </a>
                                                <a href="javascript:" class="dropdown-item"
                                                    onclick="cargar_datos_baja_activo('{{ $activo->id_activo }}')">
                                                    <i class="bx bx-circle"></i> Dar de baja
                                                </a>
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
    {{-- END ROW --}}

    {{-- Modal confirmar baja --}}

    <div class="modal fade" id="modal_activo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- Mensaje de confirmación --}}
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar baja de activo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-center" id="descripcion_modal"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_baja_activo">Si, dar de baja</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script>
        var input_id_activo = $('#input_id_activo');
        var btn_baja_activo = $('#btn_baja_activo');
        var nom_activo_label = $('#id_activo');
        var tabla_activos = $('#tabla_activos');
        var titulo_modal = $('#titulo_modal');
        var descripcion_modal = $('#descripcion_modal');
        var modal_activo = $('#modal_activo');

        let id_compra = '';
        let accion = '';

        // Inicializar datatable
        $(document).ready(function() {
            btn_baja_activo.on('click', function() {
                var url = '{{ route('activos.update', ':activo') }}';
                var metodo = 'PUT';

                if (accion === 'baja') {
                    metodo = 'DELETE';
                    url = '{{ route('activos.destroy', ':activo') }}';
                }

                $.ajax({
                    url: url.replace(':activo', id_activo),
                    method: metodo,
                    data: {
                        id_activo: id_activo,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_activos.DataTable({
                language: {
                    scrollX: "100%",
                    searchPlaceholder: 'Buscar activo...',
                    sSearch: '',

                    // Modificar el paginate de nexr y previous
                    oPaginate: {
                        sNext: '<i class="dripicons-chevron-right"></i>',
                        sPrevious: '<i class="dripicons-chevron-left"></i>'
                    },

                    // Modificar info de cuantos resultados se muestran
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ activos',

                    // Modificar el lengthMenu
                    "lengthMenu": "Mostrar _MENU_ registros",

                    // Modificar el infoEmpty de cuando no hay registros
                    "infoEmpty": 'No hay registros disponibles',

                    // Modificar el infoFiltered cuando se filtra
                    "infoFiltered": "(filtrado de _MAX_ activos en total)",

                    noRecordsFound: 'No se encontraron activos',

                    // Cambiar mensaje No matching records found
                    zeroRecords: "No se encontraron registros"
                }
            });
        });

        function cargar_datos_baja_activo(id_activo) {
            $.ajax({
                url: '{{ route('activos.show', ':activo') }}'.replace(':activo', id_activo),
                method: 'GET',
                success: function(response) {
                    if (response) {
                        id_activo = response.id_activo;
                        nom_activo = response.descrip_activo;
                        nom_activo_label.text(nom_activo);
                        descripcion_modal.text('¿Está seguro de dar de baja el activo ' + nom_activo + '?');
                        modal_activo.modal('show');
                    }
                }
            });
        }
    </script>
@endsection
