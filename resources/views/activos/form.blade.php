<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="hidden" name="id_activo" value="{{ old('id_activo', $activo->id_activo) }}">
<input class="d-none" type="hidden" name="cod_activo" value="{{ old('cod_activo', $activo->cod_activo) }}">

<div class="row mt-2">
    <div class="col-md-8">
        <div class="form-group">
            <label class="form-label">Descripción *</label>
            <textarea class="form-control @error('descrip_activo') is-invalid @enderror" name="descrip_activo" rows="1"
                placeholder="Nombre / Módelo / Serie / Color">{{ old('descrip_activo', $activo->descrip_activo) }}</textarea>
            @error('descrip_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo descripción es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="marca_activo" class="form-label">Marca activo *</label>
            <input type="text" class="form-control @error('marca_activo') is-invalid @enderror" name="marca_activo"
                id="marca_activo" placeholder="Marca" value="{{ old('marca_activo', $activo->marca_activo) }}">

            @error('marca_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo marca es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="modelo_activo" class="form-label">Modelo activo *</label>
            <input type="text" class="form-control @error('modelo_activo') is-invalid @enderror" name="modelo_activo"
                id="modelo_activo" placeholder="Modelo" value="{{ old('modelo_activo', $activo->modelo_activo) }}">

            @error('modelo_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo modelo es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="serie_activo" class="form-label">Serie activo *</label>
            <input type="text" class="form-control @error('serie_activo') is-invalid @enderror" name="serie_activo"
                id="serie_activo" placeholder="Serie" value="{{ old('serie_activo', $activo->serie_activo) }}">

            @error('serie_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo serie es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="color_activo" class="form-label">Color activo *</label>
            <input type="text" class="form-control @error('color_activo') is-invalid @enderror" name="color_activo"
                id="color_activo" placeholder="Color" value="{{ old('color_activo', $activo->color_activo) }}">

            @error('color_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo color es obligatorio.') }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="fech_compra_activo" class="form-label">Fecha de adquisición *</label>
            <input type="date" class="form-control @error('fech_compra_activo') is-invalid @enderror"
                name="fech_compra_activo" id="fech_compra_activo"
                value="{{ old('fech_compra_activo', $activo->fech_compra_activo) }}">

            @error('fech_compra_activo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty"> {{ __('El campo fecha de compra es obligatorio.') }}
                    </div>
                </div>
            @enderror
        </div>
    </div>

    {{-- Vida util del activo obtenida de tipo de activo --}}
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label" for="id_tipo">Tipo de activo</label>
            <select class="form-control custom-select" name="id_tipo" id="id_tipo">
                <option value="">Seleccione...</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo }}" data-vida-util="{{ $tipo->vida_util }}">{{ $tipo->nom_tipo }}</option>
                @endforeach
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_tipo_error"></div>
            </div>
        </div>
    </div>


    <div class="col-md-2">
        <div class="form-group">
            <label for="costo_compra_activo" class="form-label">Costo de adquisición *</label>
            <input type="text" class="form-control @error('costo_compra_activo') is-invalid @enderror"
                name="costo_compra_activo" id="costo_compra_activo" placeholder="Costo de adquisición"
                value="{{ old('costo_compra_activo', $activo->costo_compra_activo) }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="vida_util_activo" class="form-label">Vida útil</label>
            <input type="text" class="form-control @error('vida_util_activo') is-invalid @enderror"
                name="vida_util_activo" id="vida_util_activo" placeholder="Vida útil"
                value="{{ old('vida_util_activo', $activo->vida_util_activo) }}" readonly>
        </div>

        @error('vida_util_activo')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty"> {{ __('El campo vida util es obligatorio.') }}
                </div>
            </div>
        @enderror
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#id_tipo').change(function () {
                var vidaUtil = $(this).find(':selected').data('vida-util');
                $('#vida_util_activo').val(vidaUtil);
            });
        });
    </script>
@endsection

