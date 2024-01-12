<input class="d-none" type="text" name="id_producto" value="{{ old('id_producto', $producto->id_producto) }}">

<div class="row mt-2">

    <div class="col-md-8">
        <div class="form-group">
            <label class="form-label">Descripción *</label>
            <textarea class="form-control @error('descrip_producto') is-invalid @enderror" name="descrip_producto" rows="1"
                placeholder="Nombre / Módelo / Serie / Color">{{ old('descrip_producto', $producto->descrip_producto) }}</textarea>
            @error('descrip_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo descripción es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Categoria</label>
            <select class="form-control custom-select @error('id_categoria') is-invalid @enderror" name="id_categoria"
                id="id_categoria">
                <option value="">Seleccione...</option>
                @php
                    foreach ($categorias as $categoria) {
                        if ($categoria->id_categoria == old('id_categoria', $producto->id_categoria)) {
                            echo '<option value="' . $categoria->id_categoria . '" selected>' . $categoria->nom_categoria . '</option>';
                        } else {
                            echo '<option value="' . $categoria->id_categoria . '">' . $categoria->nom_categoria . '</option>';
                        }
                    }
                @endphp
            </select>
            @error('id_categoria')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo Categoria es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Precio de compra</label>
            <input type="text" class="form-control @error('precio_compra_producto') is-invalid @enderror"
                name="precio_compra_producto" placeholder="0.00" id="precio_compra_producto" readonly
                value="{{ number_format(old('precio_compra_producto', $producto->precio_compra_producto), 2) }}">

            @error('precio_compra_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo precio compra es obligatorio.') }}
                    </div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Precio de venta *</label>
            <input type="text" class="form-control @error('precio_venta_producto') is-invalid @enderror"
                name="precio_venta_producto" placeholder="0.00" id="precio_venta_producto"
                value="{{ old('precio_venta_producto', $producto->precio_venta_producto) }}">

            @error('precio_venta_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo precio venta es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="utilidad_producto">Utilidad</label>
            <input type="text" class="form-control @error('utilidad_producto') is-invalid @enderror"
                name="utilidad_producto" id="utilidad_producto" placeholder="0.00" readonly
                value="{{ $producto->precio_venta_producto - $producto->precio_compra_producto }}">

            @error('utilidad_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo utilidad es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Stock</label>
            <input type="text" class="form-control @error('stock_producto') is-invalid @enderror"
                name="stock_producto" placeholder="0" readonly
                value="{{ old('stock_producto', $producto->stock_producto) }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Stock minimo *</label>
            <input type="text" class="form-control @error('stock_min_producto') is-invalid @enderror"
                name="stock_min_producto" placeholder="0"
                value="{{ old('stock_min_producto', $producto->stock_min_producto) }}">

            @error('stock_min_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo stock min es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">Interés %</label>
            <input type="text" class="form-control @error('interes_producto') is-invalid @enderror"
                name="interes_producto" placeholder="0.0000%"
                value="{{ number_format(old('interes_producto', $producto->interes_producto), 4) }}">

            @error('interes_producto')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ __('El campo interes es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>


</div>
