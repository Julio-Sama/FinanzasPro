@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tipos de Activo</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('tipos.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nuevo
                    Tipo</a>
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
                    <h3 class="card-title">Listado de Tipos de activo</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_tipos">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Vida util</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tipos as $tipo)

                            <tr>
                                <td>{{ $tipo->id_tipo }}</td>
                                <td>{{ $tipo->nom_tipo }}</td>
                                <td>{{ $tipo->vida_util }} años</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                            <a class="dropdown-item" href="{{ route('tipos.show', $tipo) }}">
                                                <i class='bx bx-show'></i> Ver
                                            </a>
                                            <a class="dropdown-item" href="{{ route('tipos.edit', $tipo) }}">
                                                <i class='bx bx-edit-alt'></i> Modificar
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:"
                                            onclick="cargar_datos_eliminar_tipo('{{ $tipo->nom_tipo }}', '{{ $tipo->id_tipo }}')"
                                            data-bs-toggle="modal" data-bs-target="#modal_eliminar_tipo">
                                                <i class='bx bx-trash'></i> Eliminar
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

    <!-- Modal eliminar tipo -->
    <div class="modal fade" id="modal_eliminar_tipo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar tipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <input class="d-none" id="input_id_tipo">

                <div class="modal-body">
                    <p class="text-center">¿Está seguro que desea eliminar el tipo <span
                            id="nom_tipo"></span>?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_eliminar_tipo">Si, eliminar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>


    <script>
        var input_id_tipo = $('#input_id_tipo');
        var btn_eliminar_tipo = $('#btn_eliminar_tipo');
        var nom_tipo_label = $('#nom_tipo');
        const tabla_tipos = $('#tabla_tipos');

        $(document).ready(function () {
            btn_eliminar_tipo.on('click', function () {
                var id_tipo = input_id_tipo.val();

                $.ajax({
                    url: '{{ route('tipos.destroy', ':tipo')  }}'.replace(':tipo', id_tipo),
                    method: 'DELETE',
                    data: {
                        id_tipo: id_tipo,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_tipos.DataTable({
                language: {
                    scrollX: "100%",
                    searchPlaceholder: 'Buscar tipo...',
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

                    noRecordsFound: 'No hay tipos registrados',

                    // Cambiar mensaje No matching records found
                    zeroRecords: "No se encontraron registros coincidentes",

                }
            })
        });

        function cargar_datos_eliminar_tipo(nom_tipo, id_tipo) {
            input_id_tipo.val(id_tipo);
            nom_tipo_label.html(nom_tipo);
        }

    </script>

@endsection
