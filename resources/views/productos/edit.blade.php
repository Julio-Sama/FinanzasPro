@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @method('PUT')
        @csrf

        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
                <li class="breadcrumb-item active" aria-current="page">Modificar</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="bx bx-edit-alt"></i> Modificar</button>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modificar producto</h3>
                    </div>
                    <div class="card-body">
                        @include('productos.form')
                    </div>
                    <div class="card-footer">
                        Los campos con (*) son obligatorios.
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        let id_categoria = $('#id_categoria');
        let precio_compra_producto = $('#precio_compra_producto');
        let precio_venta_producto = $('#precio_venta_producto');
        let utilidad_producto = $('#utilidad_producto');

        $(document).ready(function () {
            id_categoria.select2({
                placeholder: 'Seleccione un tipo de comprobante',
                minimumResultsForSearch: ''
            });

            precio_venta_producto.on('input', function () {
                calcultar_utilidad();
            });
        })

        function calcultar_utilidad(){
            let precio_compra = parseFloat(precio_compra_producto.val());
            let precio_venta = parseFloat(precio_venta_producto.val());

            if(precio_compra <= precio_venta) {
                let utilidad = (precio_venta - precio_compra);

                utilidad_producto.val(utilidad.toFixed(2));
            }else{
                utilidad_producto.val('0.00');
            }
        }
    </script>

@endsection
