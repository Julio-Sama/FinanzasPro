<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="hidden" name="id_compra" value="{{ old('id_compra', $compra->id_compra) }}">

<div class="row mt-2">
    @if ($compra->id_compra != null)
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="id_compra">N° de Compra</label>
                <input type="text" class="form-control" name="id_compra" id="id_compra"
                    value="{{ $compra->id_compra }}">
            </div>
        </div>

        {{--        Fecha --}}
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="fecha_compra">Fecha de realización</label>
                <input type="text" class="form-control" name="fecha_compra" id="fecha_compra"
                    value="{{ $compra->fech_compra }}">
            </div>
        </div>

        {{--        Estado --}}
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="estado_compra">Estado</label>
                <p class="form-control boder border-0">
                    @if ($compra->estado_compra == 'Finalizada')
                        <span class="badge bg-success">{{ $compra->estado_compra }}</span>
                    @else
                        <span class="badge bg-danger">{{ $compra->estado_compra }}</span>
                    @endif
                </p>
            </div>
        </div>
    @endif

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="id_proveedor">Proveedor *</label>
            <select class="form-control custom-select" name="id_proveedor" id="id_proveedor">
                <option value="">Seleccione...</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" @if (old('id_proveedor', $compra->id_proveedor) == $proveedor->id_proveedor) selected @endif>
                        {{ $proveedor->nom_proveedor }}</option>
                @endforeach
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_proveedor_error"></div>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="comprobante_compra">Tipo comprobante *</label>
            <select class="form-control custom-select" name="comprobante_compra" id="comprobante_compra">
                <option value="">Seleccione...</option>
                <option value="Consumidor final" @if (old('comprobante_compra', $compra->comprobante_compra) == 'Consumidor final') selected @endif>Consumidor final
                </option>
                <option value="Crédito fiscal" @if (old('comprobante_compra', $compra->comprobante_compra) == 'Crédito fiscal') selected @endif>Crédito fiscal
                </option>
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="comprobante_compra_error"></div>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="condicion_pago_compra">Condición de pago *</label>
            <select class="form-control custom-select" name="condicion_pago_compra" id="condicion_pago_compra">
                <option value="">Seleccione...</option>
                <option value="Crédito" @if (old('condicion_pago_compra', $compra->condicion_pago_compra) == 'Crédito') selected @endif>
                    Crédito
                </option>
                <option value="Contado" @if (old('condicion_pago_compra', $compra->condicion_pago_compra) == 'Contado') selected @endif>
                    Contado
                </option>
            </select>
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="condicion_pago_compra_error"></div>
            </div>

        </div>
    </div>

    @if ($compra->id_compra == null)
        <div class="col-md-7">
            <div class="form-group">
                <label class="form-label" for="id_producto">Producto *</label>
                <select class="form-control custom-select" name="id_producto" id="id_producto">
                    <option value="">Seleccione...</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->descrip_producto }}</option>
                    @endforeach
                </select>

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="id_producto_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label class="form-label" for="cant_detalle_compra">Cantidad *</label>
                <input type="number" class="form-control @error('cant_detalle_compra') is-invalid @enderror"
                    name="cant_detalle_compra" min="1" id="cant_detalle_compra"
                    value="{{ old('cant_detalle_compra', 1) }}">


                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="cant_detalle_compra_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="form-label" for="precio_detalle_compra">Precio *</label>
                <input type="text" class="form-control @error('precio_detalle_compra') is-invalid @enderror"
                    name="precio_detalle_compra" placeholder="0.00" id="precio_detalle_compra"
                    value="{{ old('precio_detalle_compra', '') }}">


                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="precio_detalle_compra_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-2 m-auto align-items-baseline">
            <button type="button" class="btn btn-outline-success w-100" id="btn_agregar_producto">Agregar
                producto</button>
        </div>
    @endif
    {{--    Boton agregar producto --}}

    {{--    Total de Compra --}}
    <input class="d-none" name="total_compra">

    {{--    Tabla de productos agregados --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalle de compra</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm" id="tabla_productos">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Producto</td>
                            <td>Cantidad</td>
                            <td>Precio Unitario</td>
                            <td>Total</td>
                            @if ($compra->id_compra == null)
                                <td>Acciones</td>
                            @endif

                        </tr>
                    </thead>
                    <tbody id="tbody_productos">
                        <tr>
                            <td colspan="6" class="text-center">No hay productos agregados</td>
                        </tr>
                    </tbody>
                    <tfoot class="text-end">
                        <tr>
                            <td colspan="4" class="text-right">Subtotal</td>
                            <td id="subtotal_compra">0.00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">IVA (%)</td>
                            <td id="iva_compra">0.00</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">TOTAL</td>
                            <td id="total_compra">0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
