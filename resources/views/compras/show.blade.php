@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form id="form_compra">
        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compras</li>
                <li class="breadcrumb-item active" aria-current="page">Ver</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('compras.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Atrás</a>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ver compra</h3>
                    </div>
                    <div class="card-body">
                        @include('compras.form')
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var form = $('#form_compra');
            var inputs = form.find('input');
            var selects = form.find('select');
            var textareas = form.find('textarea');

            inputs.each(function () {
                $(this).prop('disabled', true);
            });

            selects.each(function () {
                $(this).prop('disabled', true);
            });

            textareas.each(function () {
                $(this).prop('disabled', true);
            });

            cargarDetalles()

        });

        function cargarDetalles(){
            var compra = (@json($compra)) ? @json($compra) : null;

            var detalles = compra.detalle_producto_compra;
            var total = 0;

            // Limpiar tabla
            $('#tbody_productos').html('');

            detalles.forEach(function (detalle) {
                var producto = detalle.producto;
                var cantidad = detalle.cant_detalle_compra;
                var precio = detalle.precio_detalle_compra;
                var subtotal = precio * cantidad;


                var fila = '<tr>' +
                    '<td>' + producto.id_producto + '</td>' +
                    '<td>' + producto.descrip_producto + '</td>' +
                    '<td>' + cantidad + '</td>' +
                    '<td>' + precio.toFixed(2) + '</td>' +
                    '<td>' + subtotal.toFixed(2) + '</td>' +
                    '</tr>';

                total += subtotal;

                $('#tbody_productos').append(fila);
            });

            $('#subtotal_compra').text(total.toFixed(2));
            $('#iva_compra').text((total * 0.13).toFixed(2));
            $('#total_compra').text((total * 1.13).toFixed(2));

            console.log(detalles);
        }

    </script>
@endsection
