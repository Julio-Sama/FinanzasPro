<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="text" name="id_tipo" value="{{ old('id_tipo', $tipo->id_tipo) }}">

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Nombre *</label>
            <input type="text" class="form-control @error('nom_tipo') is-invalid @enderror" name="nom_tipo"
                placeholder="-" value="{{ old('nom_tipo', $tipo->nom_tipo) }}">
            @error('nom_tipo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>

        {{-- vida util del tipo de activo --}}
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="vida_util" class="form-label">Vida util *</label>
            <input type="text" class="form-control @error('vida_util') is-invalid @enderror"
                name="vida_util" id="vida_util" placeholder="Vida util en años"
                value="{{ old('vida_util', $tipo->vida_util) }}">
            @error('vida_util_tipo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                @enderror
            </div>
            <small class="form-text text-muted"><p>Maquinaria y equipo de transporte: 10 años</p>
            <p>Bienes muebles, computación, oficina y otros: 5 años</p></small> <!-- Added banner -->
        </div>
    </div>

    </div>
    {{-- Informacion sobre la vida util --}}
</div>
