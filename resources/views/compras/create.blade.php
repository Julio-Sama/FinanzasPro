@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form action="{{ route('compras.store') }}" method="POST" id="form_compra">

        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item" aria-current="page">Compras</li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('compras.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Cancelar</a>
                    <button type="button" class="btn btn-success" id="btn_registrar_compra">
                        <i class="bx bx-save"></i> Registrar
                    </button>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nueva compra</h3>
                    </div>
                    <div class="card-body">
                        @include('compras.form')
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
        const proveedores = $('#id_proveedor');
        const productos = $('#id_producto');
        const comprobante = $('#comprobante_compra');
        const condicion = $('#condicion_pago_compra');

        const btn_agregar_producto = $('#btn_agregar_producto');

        const tabla_productos = $('#tbody_productos');

        let listado_productos = [];
        let listado_productos_agregados = [];

        const input_precio_compra = $('#precio_detalle_compra');
        const input_cantidad = $('#cant_detalle_compra');

        const input_total = $('#total_compra');
        const input_subtotal = $('#subtotal_compra');
        const input_iva = $('#iva_compra');

        const btn_registrar_compra = $('#btn_registrar_compra');

        const form_compra = $('#form_compra');

        const label_id_producto_error = $('#id_producto_error');
        const label_cant_detalle_compra_error = $('#cant_detalle_compra_error');
        const label_precio_detalle_compra_error = $('#precio_detalle_compra_error');

        // Obtener elemento por el atributo name
        const input_total_compra = document.querySelector('[name="total_compra"]');

        let producto_seleccionado = null;

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            // Eliminar errores de validación
            $('input').on('keyup', function () {
                $(this).removeClass('is-invalid');
            });

            $('select').on('change', function () {
                $(this).removeClass('is-invalid');
            });

            btn_registrar_compra.on('click', function () {
                $.ajax({
                    url: '{{ route("compras.store") }}',
                    type: 'post',
                    dataType: 'json',
                    data: form_compra.serialize() + '&productos=' + JSON.stringify(listado_productos_agregados),
                    success: function (data) {
                        if(data.success){
                            window.location.href = data.redirect;
                        }else{
                            tabla_productos.html(`
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Debe agregar por lo menos un producto</td>
                                </tr>
                            `);
                        }
                    },
                    error: function (xhr) {
                        // Mostrar errores de validación
                        if (xhr.status === 422) {
                            var data = xhr.responseJSON;

                            if ($.isEmptyObject(data.errors) === false) {
                                $.each(data.errors, function (key, value) {
                                    // Mostrar errores en los inputs
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key + '_error').html(value); // Agregar el mensaje de error
                                    $('#' + key + '_label').addClass('border border-danger rounded')
                                });
                            }
                        }
                    }
                });
            });

            comprobante.select2({
                placeholder: 'Seleccione un tipo de comprobante',
                minimumResultsForSearch: Infinity
            });

            condicion.select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Seleccione una condición de pago',
            });

            proveedores.select2({
                placeholder: 'Seleccione un proveedor',
                minimumResultsForSearch: ''
            });

            productos.select2({
                placeholder: 'Seleccione un producto',
                minimumResultsForSearch: ''
            });

            cargarProductos();

            productos.on('select2:select', function (e) {
                const data = e.params.data;
                producto_seleccionado = listado_productos.find(p => p.id_producto == data.id);

                input_precio_compra.val(parseFloat(producto_seleccionado.precio_compra_producto).toFixed(2));
                input_cantidad.val(producto_seleccionado.stock_min_producto);
            });

            btn_agregar_producto.on('click', function (e) {
                e.preventDefault();

                if (listado_productos_agregados.length === 0) {
                    tabla_productos.html('');
                }

                if(producto_seleccionado === null) {
                    productos.addClass('is-invalid');
                    label_id_producto_error.html('Seleccione un producto'); // Agregar el mensaje de error
                    return;
                }

                if(input_cantidad.val() === '' || input_cantidad.val() <= 0){
                    input_cantidad.addClass('is-invalid');
                    label_cant_detalle_compra_error.html('Ingrese una cantidad mayor a 0'); // Agregar el mensaje de error
                    return;
                }

                if(input_precio_compra.val() <= 0){
                    input_precio_compra.addClass('is-invalid');
                    label_precio_detalle_compra_error.html('Ingrese un precio mayor a 0.00'); // Agregar el mensaje de error
                    return;
                }

                const producto_agregado = {
                    id_producto: producto_seleccionado.id_producto,
                    descrip_producto: producto_seleccionado.descrip_producto,
                    cant_detalle_compra: input_cantidad.val(),
                    precio_detalle_compra: parseFloat(input_precio_compra.val()).toFixed(2),
                    total_detalle_compra: (input_cantidad.val() * input_precio_compra.val()).toFixed(2)
                };

                // Agregar al listado de productos agregados
                listado_productos_agregados.push(producto_agregado);
                insertarFila(producto_agregado); // Insertar fila en la tabla

                console.log(listado_productos_agregados);

                calcularTotales();
                reiniciarFormulario();
            });

        });

        function cargarProductos(){
            @foreach($productos as $producto)
                listado_productos.push(
                    {!! html_entity_decode(nl2br(e(json_encode($producto)))) !!}
                );
            @endforeach
        }

        function insertarFila(producto_agregado){
            tabla_productos.append(`
                    <tr>
                        <td>${producto_agregado.id_producto}</td>
                        <td>${producto_agregado.descrip_producto}</td>
                        <td>${producto_agregado.cant_detalle_compra}</td>
                        <td>${producto_agregado.precio_detalle_compra}</td>
                        <td>${producto_agregado.total_detalle_compra}</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm btn-eliminar-producto" data-id="${producto_agregado.id_producto}">
                                <i class="bx bx-trash m-0"></i>
                            </button>
                        </td>
                    </tr>
                `);
        }

        function reiniciarFormulario(){
            input_precio_compra.val('');
            input_cantidad.val(1);
            productos.val(null).trigger('change');
            producto_seleccionado = null;
        }

        // Calcular totales de la compra
        function calcularTotales(){
            let subtotal = 0;
            let iva = 0;
            let total = 0;

            listado_productos_agregados.forEach(p => {
                subtotal += parseFloat(p.total_detalle_compra);
            });

            iva = subtotal * 0.13;
            total = subtotal + iva;

            input_subtotal.html(subtotal.toFixed(2));
            input_iva.html(iva.toFixed(2));
            input_total.html(total.toFixed(2));

            input_total_compra.value = total.toFixed(2);
        }

        // Eliminar producto de la tabla
        $(document).on('click', '.btn-eliminar-producto', function (e) {
            e.preventDefault();

            const id_producto = $(this).data('id');
            const index = listado_productos_agregados.findIndex(p => p.id_producto == id_producto);

            listado_productos_agregados.splice(index, 1);
            $(this).closest('tr').remove();

            if (listado_productos_agregados.length === 0) {
                tabla_productos.html(`
                    <tr>
                        <td colspan="6" class="text-center">No hay productos agregados</td>
                    </tr>
                `);
            }

            calcularTotales();
        });

    </script>
@endsection
