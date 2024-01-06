@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categorias</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nueva
                    Categoria</a>
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
                    <h3 class="card-title">Listado de Categorias</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_categorias">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categorias as $categoria)

                            <tr>
                                <td>{{ $categoria->id_categoria }}</td>
                                <td>{{ $categoria->nom_categoria }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                            <a class="dropdown-item" href="{{ route('categorias.show', $categoria) }}">
                                                <i class='bx bx-show'></i> Ver
                                            </a>
                                            <a class="dropdown-item" href="{{ route('categorias.edit', $categoria) }}">
                                                <i class='bx bx-edit-alt'></i> Modificar
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:"
                                               onclick="cargar_datos_eliminar_categoria('{{ $categoria->nom_categoria }}', '{{ $categoria->id_categoria }}')"
                                               data-bs-toggle="modal" data-bs-target="#modal_eliminar_categoria">
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

    <!-- Modal eliminar categoria -->
    <div class="modal fade" id="modal_eliminar_categoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <input class="d-none" id="input_id_categoria">

                <div class="modal-body">
                    <p class="text-center">¿Está seguro que desea eliminar el categoria <span
                            id="nom_categoria"></span>?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_eliminar_categoria">Si, eliminar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>


    <script>
        var input_id_categoria = $('#input_id_categoria');
        var btn_eliminar_categoria = $('#btn_eliminar_categoria');
        var nom_categoria_label = $('#nom_categoria');
        const tabla_categorias = $('#tabla_categorias');

        $(document).ready(function () {
            btn_eliminar_categoria.on('click', function () {
                var id_categoria = input_id_categoria.val();

                $.ajax({
                    url: '{{ route('categorias.destroy', ':categoria')  }}'.replace(':categoria', id_categoria),
                    method: 'DELETE',
                    data: {
                        id_categoria: id_categoria,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_categorias.DataTable({
                language: {
                    scrollX: "100%",
                    searchPlaceholder: 'Buscar categoria...',
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

                    noRecordsFound: 'No hay categorias registradas',

                    // Cambiar mensaje No matching records found
                    zeroRecords: "No se encontraron registros coincidentes",

                }
            })
        });

        function cargar_datos_eliminar_categoria(nom_categoria, id_categoria) {
            input_id_categoria.val(id_categoria);
            nom_categoria_label.html(nom_categoria);
        }

    </script>

@endsection
