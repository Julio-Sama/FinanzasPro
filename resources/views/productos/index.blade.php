@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol><!-- End breadcrumb -->
        <div class="ms-auto">
            <div>
                <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Nuevo
                    Producto</a>
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
                    <h3 class="card-title">Listado de Productos</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="tabla_productos">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productos as $producto)

                            <tr>
                                <td>{{ $producto->id_producto }}</td>
                                <td>{{ $producto->descrip_producto }}</td>
                                <td>${{ number_format($producto->precio_venta_producto, 2) }}</td>
                                <td>{{ $producto->stock_producto }}</td>
                                <td>{{ $producto->nom_categoria }}</td>
                                <td>
                                    @if ($producto->stock_producto == 0)
                                        <span class="badge bg-danger">Sin stock</span>
                                    @elseif($producto->stock_producto <= $producto->stock_min_producto)
                                        <span class="badge bg-warning">Stock bajo</span>
                                    @else
                                        <span class="badge bg-success">Con stock</span>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                            <a class="dropdown-item" href="{{ route('productos.show', $producto) }}">
                                                <i class='bx bx-show'></i> Ver
                                            </a>
                                            <a class="dropdown-item" href="{{ route('productos.edit', $producto) }}">
                                                <i class='bx bx-edit-alt'></i> Modificar
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:"
                                               onclick="cargar_datos_eliminar_producto('{{ $producto->descrip_producto }}', '{{ $producto->id_producto }}')"
                                               data-bs-toggle="modal" data-bs-target="#modal_eliminar_producto">
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

    <!-- Modal eliminar producto -->
    <div class="modal fade" id="modal_eliminar_producto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <input class="d-none" id="input_id_producto">

                <div class="modal-body">
                    <p class="text-center">¿Está seguro que desea eliminar el producto <span
                            id="nom_producto"></span>?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btn_eliminar_producto">Si, eliminar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>

    <script>
        var input_id_producto = $('#input_id_producto');
        var btn_eliminar_producto = $('#btn_eliminar_producto');
        var nom_producto_label = $('#nom_producto');

        const tabla_productos = $('#tabla_productos');

        $(document).ready(function () {
            btn_eliminar_producto.on('click', function () {
                var id_producto = input_id_producto.val();

                $.ajax({
                    url: '{{ route('productos.destroy', ':producto')  }}'.replace(':producto', id_producto),
                    method: 'DELETE',
                    data: {
                        id_producto: id_producto,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    }
                });
            });

            tabla_productos.DataTable({
                language: {
                    scrollX: "100%",
                    searchPlaceholder: 'Buscar producto...',
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

                    noRecordsFound: 'No hay productos registrados',

                    // Cambiar mensaje No matching records found
                    zeroRecords: "No se encontraron registros coincidentes",

                }
            })
        });

        function cargar_datos_eliminar_producto(nom_producto, id_producto) {
            input_id_producto.val(id_producto);
            nom_producto_label.html(nom_producto);
        }

    </script>

@endsection
