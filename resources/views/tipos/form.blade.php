<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="text" name="id_tipo" value="{{ old('id_tipo', $tipo->id_tipo)  }}">

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Nombre *</label>
            <input type="text" class="form-control @error('nom_tipo') is-invalid @enderror" name="nom_tipo"
                placeholder="-"
                value="{{ old('nom_tipo', $tipo->nom_tipo) }}">

            @error('nom_tipo')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

</div>
