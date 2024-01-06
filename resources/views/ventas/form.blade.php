<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="hidden" name="id_venta" value="{{ old('id_venta', $venta->id_venta) }}">

<div class="row mt-2">
    @if($venta->id_venta != null)
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="id_venta">N° de Venta</label>
                <input type="text" class="form-control"
                       name="id_venta"
                       id="id_venta"
                       value="{{ $venta->id_venta }}">
            </div>
        </div>

        {{--        Fecha --}}
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="fecha_venta">Fecha de realización</label>
                <input type="text" class="form-control"
                       name="fecha_venta"
                       id="fecha_venta"
                       value="{{ $venta->fech_venta }}">
            </div>
        </div>

        {{--        Estado --}}
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label" for="estado_venta">Estado</label>
                <p class="form-control boder border-0">
                    @if ($venta->estado_venta == 'Finalizada')
                        <span class="badge bg-success">{{ $venta->estado_venta }}</span>
                    @else
                        <span class="badge bg-danger">{{ $venta->estado_venta }}</span>
                    @endif
                </p>
            </div>
        </div>
    @endif

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="id_cliente">Cliente *</label>
            <select class="form-control custom-select" name="id_cliente" id="id_cliente">
                <option value="">Seleccione...</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}"
                            @if(old('id_cliente', $venta->id_cliente) == $cliente->id_cliente) selected @endif>{{ $cliente->nom_cliente }}</option>
                @endforeach
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_cliente_error"></div>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="comprobante_venta">Tipo comprobante *</label>
            <select class="form-control custom-select" name="comprobante_venta" id="comprobante_venta">
                <option value="">Seleccione...</option>
                <option value="Consumidor final"
                        @if(old('comprobante_venta', $venta->comprobante_venta) == 'Consumidor final') selected @endif>Consumidor final
                </option>
                <option value="Crédito fiscal"
                        @if(old('comprobante_venta', $venta->comprobante_venta) == 'Crédito fiscal') selected @endif>Crédito fiscal
                </option>
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="comprobante_venta_error"></div>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="condicion_pago_venta">Condición de pago *</label>
            <select class="form-control custom-select" name="condicion_pago_venta" id="condicion_pago_venta">
                <option value="">Seleccione...</option>

                <option value="Contado"
                        @if(old('condicion_pago_venta', $venta->condicion_pago_venta) == 'Contado') selected @endif>
                    Contado
                </option>

                <option value="Crédito"
                        @if(old('condicion_pago_venta', $venta->condicion_pago_venta) == 'Crédito') selected @endif>
                    Crédito
                </option>
            </select>
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="condicion_pago_venta_error"></div>
            </div>

        </div>
    </div>

    @if($venta->id_venta == null)
        <div class="col-md-7">
            <div class="form-group">
                <label class="form-label" for="id_producto">Producto *</label>
                <select class="form-control custom-select" name="id_producto" id="id_producto">
                    <option value="">Seleccione...</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id_producto }}">{{ $producto->descrip_producto }} | Stock: {{ $producto->stock_producto }}</option>
                    @endforeach
                </select>

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="id_producto_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label class="form-label" for="cant_detalle_venta">Cantidad *</label>
                <input type="number" class="form-control @error('cant_detalle_venta') is-invalid @enderror"
                       name="cant_detalle_venta"
                       min="1"
                       id="cant_detalle_venta"
                       value="{{ old('cant_detalle_venta', 1) }}">


                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="cant_detalle_venta_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label class="form-label" for="precio_detalle_venta">Precio *</label>
                <input type="text" class="form-control @error('precio_detalle_venta') is-invalid @enderror"
                       name="precio_detalle_venta"
                       placeholder="0.00"
                       id="precio_detalle_venta"
                       readonly
                       value="{{ old('precio_detalle_venta', '') }}">


                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="precio_detalle_venta_error"></div>
                </div>

            </div>
        </div>

        <div class="col-md-2 m-auto align-items-baseline">
            <button type="button" class="btn btn-outline-success w-100" id="btn_agregar_producto">Agregar producto</button>
        </div>
    @endif
    {{--    Boton agregar producto --}}

    {{--    Total de Venta --}}
    <input class="d-none" name="total_venta">

    {{--    Tabla de productos agregados --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalle de venta</h3>
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
                        @if($venta->id_venta == null) <td>Acciones</td> @endif

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
                        <td id="subtotal_venta">0.00</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">IVA (%)</td>
                        <td id="iva_venta">0.00</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">TOTAL</td>
                        <td id="total_venta">0.00</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
