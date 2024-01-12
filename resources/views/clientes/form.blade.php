<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="hidden" name="id_cliente" value="{{ old('id_cliente', $cliente->id_cliente) }}">
<input class="d-none" type="hidden" name="cod_cliente" value="{{ old('cod_cliente', $cliente->cod_cliente) }}">


<div class="row @if ($cliente->id_cliente != null) d-none @endif">
    <div class="form-label">Tipo de cliente</div>
    <div class="custom-controls-stacked">
        <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="tipo_cliente" value="Natural" checked
                id="check_natural">
            <span class="custom-control-label">Natural</span>
        </label>
        <label class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" name="tipo_cliente" value="Jurídico"
                @if (old('tipo_cliente', $cliente->tipo_cliente) == 'Jurídico') checked @endif id="check_juridico">
            <span class="custom-control-label">Jurídico</span>
        </label>
    </div>
</div>

<div class="row mt-2" id="natural">
    <div class="col-md-3 @if (old('tipo_cliente', $cliente->tipo_cliente) == 'Jurídico') d-none @endif" id="div_dui">
        <div class="form-group">
            <label class="form-label" for="dui_cliente">DUI</label>
            <input type="text" class="form-control" name="dui_cliente" placeholder="00000000-0" id="dui_cliente"
                @if ($cliente->tipo_cliente == 'Jurídico') disabled @endif
                value="{{ old('dui_cliente', $cliente->dui_cliente) }}">
        </div>
    </div>

    <div class="col-md-3 @if (old('tipo_cliente', $cliente->tipo_cliente) != 'Jurídico') d-none @endif" id="div_nit">
        <div class="form-group">
            <label class="form-label" for="nit_cliente">NIT</label>
            <input type="text" class="form-control" name="nit_cliente" placeholder="0000-000000-000-0"
                id="nit_cliente" value="{{ old('nit_cliente', $cliente->nit_cliente) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="nom_cliente">Nombre *</label>
            <input type="text" class="form-control @error('nom_cliente') is-invalid @enderror" name="nom_cliente"
                id="nom_cliente" placeholder="ej. Juan, Distribuidora las caras"
                value="{{ old('nom_cliente', $cliente->nom_cliente) }}">

            @error('nom_cliente')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label" for="tel_cliente">Teléfono *</label>
            <input type="text" class="form-control @error('tel_cliente') is-invalid @enderror" name="tel_cliente"
                id="tel_cliente" placeholder="0000-0000" value="{{ old('tel_cliente', $cliente->tel_cliente) }}">

            @error('tel_cliente')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label" for="dir_cliente">Dirección *</label>
            <textarea class="form-control @error('dir_cliente') is-invalid @enderror" name="dir_cliente" rows="1"
                id="dir_cliente" placeholder="Ciudad / Calle / Barrio / Casa">{{ old('dir_cliente', $cliente->dir_cliente) }}</textarea>
            @error('dir_cliente')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="ingreso_cliente">
                @if (old('tipo_cliente', $cliente->tipo_cliente) == 'Jurídico')
                    Activo corriente
                @else
                    Ingreso
                @endif
            </label>
            <input type="text" class="form-control" name="ingreso_cliente" placeholder="0.00" id="ingreso_cliente"
                value="{{ old('ingreso_cliente', $cliente->ingreso_cliente) }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label" for="egreso_cliente">
                @if (old('tipo_cliente', $cliente->tipo_cliente) == 'Jurídico')
                    Pasivo corriente
                @else
                    Egreso
                @endif
            </label>
            <input type="text" class="form-control" name="egreso_cliente" placeholder="0.00" id="egreso_cliente"
                value="{{ old('egreso_cliente', $cliente->egreso_cliente) }}">
        </div>
    </div>


    <div id="section_natural" class="row pe-0 @if (old('tipo_cliente', $cliente->tipo_cliente) == 'Jurídico') d-none @endif">
        <div class="col-md-6 pe-1">
            <div class="form-group">
                <label class="form-label" for="estado_civil_cliente">Estado civil</label>
                <select class="form-control custom-select" name="estado_civil_cliente" id="estado_civil_cliente">
                    <option value="">Seleccione...</option>
                    @php
                        $estados_civiles = ['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a', 'Unión libre'];

                        foreach ($estados_civiles as $estado_civil) {
                            if (old('estado_civil_cliente', $cliente->estado_civil_cliente) == $estado_civil) {
                                echo '<option value="' . $estado_civil . '" selected>' . $estado_civil . '</option>';
                            } else {
                                echo '<option value="' . $estado_civil . '">' . $estado_civil . '</option>';
                            }
                        }
                    @endphp
                </select>
            </div>
        </div>

        <div class="col-md-6 ps-4 pe-0">
            <div class="form-group">
                <label class="form-label" for="lugar_trabajo_cliente">Lugar de trabajo</label>
                <input type="text" class="form-control" name="lugar_trabajo_cliente" id="lugar_trabajo_cliente"
                    value="{{ old('lugar_trabajo_cliente', $cliente->lugar_trabajo_cliente) }}">
            </div>
        </div>
    </div>
</div>
