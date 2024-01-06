@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <!-- breadcrumb -->
            <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
            <li class="breadcrumb-item" aria-current="page">Productos</li>
            <li class="breadcrumb-item active" aria-current="page">Tarejta Kardex</li>
        </ol><!-- End breadcrumb -->
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
                    <h3 class="card-title">Tarjeta Kardex</h3>
                </div>
                <div class="card-body">
                    <form action="" method="GET" id="form_kardex">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label" for="id_producto">Producto *</label>
                                    <select class="form-control custom-select" name="id_producto" id="id_producto">
                                        <option value="">Seleccione...</option>
                                        @foreach($productos as $producto)
                                            <option
                                                value="{{ $producto->id_producto }}" @if($id_producto == $producto->id_producto) selected @endif>{{ $producto->descrip_producto }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="name" data-validator="notEmpty" id="id_producto_error"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="select_anio">Año</label>
                                    <select class="form-control custom-select" name="anio" id="select_anio">
                                        @foreach($anios as $a)
                                            <option value="{{ $a }}" @if($anio == $a) selected @endif>{{ $a }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2 m-auto align-items-baseline">
                                <button type="submit" class="btn btn-outline-success w-100" id="btn_generar_kardex">
                                    Generar kardex
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-hover table-bordered table-sm" id="tabla_productos">
                        <thead class="text-center">
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Fecha</th>
                            <th rowspan="2">Concepto</th>
                            <th rowspan="2">C. U.</th>
                            <th colspan="2">Entradas</th>
                            <th colspan="2">Salidas</th>
                            <th colspan="2">Saldos</th>
                        </tr>
                        <tr>
                            <th>Cant</th>
                            <th>C. T.</th>
                            <th>Cant</th>
                            <th>C. T.</th>
                            <th>Cant</th>
                            <th>C. T.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kardex as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k['fecha'] }}</td>
                                @if($k['tipo'] == 'Compra')
                                    <td>{{ ($loop->iteration != 1) ? $k['tipo'] . " C. " . $k['descripcion'] : 'Inventario inicial' }}</td>

                                @elseif($k['tipo'] == 'Venta')
                                    <td>{{ $k['tipo'] . " V. " . $k['descripcion'] }}</td>
                                @else
                                    <td>(Inventario) {{ 'C. ' . $k['descripcion'] }}</td>
                                @endif
                                <td class="text-end">{{ $k['costo_unit'] }}</td>
                                @if($k['tipo'] == 'Compra')
                                    <td class="text-center">{{ $k['cant'] }}</td>
                                    <td class="text-end">{{ $k['costo_total'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">{{ $k['cant'] }}</td>
                                    <td class="text-end">{{ $k['costo_total'] }}</td>
                                @elseif($k['tipo'] == 'Venta')
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">{{ $k['cant'] }}</td>
                                    <td class="text-end">{{ $k['costo_total'] }}</td>
                                    <td class="text-center">{{ $k['cant_saldo'] }}</td>
                                    <td class="text-end">{{ $k['costo_saldo'] }}</td>

                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">{{ $k['cant'] }}</td>
                                    <td class="text-end">{{ $k['costo_total'] }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>

    <script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        const input_id_producto = $('#input_id_producto');
        const btn_eliminar_producto = $('#btn_eliminar_producto');
        const nom_producto_label = $('#nom_producto');

        const tabla_productos = $('#tabla_productos');

        const productos = $('#id_producto');

        $(document).ready(function () {
            productos.select2({
                placeholder: 'Seleccione un producto',
                minimumResultsForSearch: ''
            });
        });
    </script>

@endsection
