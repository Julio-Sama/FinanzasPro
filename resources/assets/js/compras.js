const proveedores = $('#id_proveedor');
const productos = $('#id_producto');
const comprobante = $('#comprobante_compra');
const condicion = $('#condicion_pago_compra');

$(document).ready(function () {
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

});

