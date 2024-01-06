
<input class="d-none" type="text" name="id_proveedor" value="{{ old('id_proveedor', $proveedor->id_proveedor)  }}">

<div class="row mt-2">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">Nombre *</label>
            <input type="text" class="form-control @error('nom_proveedor') is-invalid @enderror" name="nom_proveedor"
                   placeholder="-"
                   value="{{ old('nom_proveedor', $proveedor->nom_proveedor) }}">

            @error('nom_proveedor')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Teléfono *</label>
            <input type="text" class="form-control @error('tel_proveedor') is-invalid @enderror" name="tel_proveedor"
                   placeholder="0000-0000" value="{{ old('tel_proveedor', $proveedor->tel_proveedor) }}">

            @error('tel_proveedor')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-label">Correo electrónico *</label>
            <input type="email" class="form-control @error('email_proveedor') is-invalid @enderror" name="email_proveedor"
                   placeholder="ejemplo@ejemplo.com" value="{{ old('email_proveedor', $proveedor->email_proveedor) }}">

            @error('email_proveedor')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Dirección *</label>
            <textarea class="form-control @error('dir_proveedor') is-invalid @enderror" name="dir_proveedor" rows="1"
                      placeholder="Ciudad / Calle / Barrio / Casa">{{ old('dir_proveedor', $proveedor->dir_proveedor) }}</textarea>
            @error('dir_proveedor')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

</div>
