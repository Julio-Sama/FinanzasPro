<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

<input class="d-none" type="text" name="id_categoria" value="{{ old('id_categoria', $categoria->id_categoria)  }}">

<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Nombre *</label>
            <input type="text" class="form-control @error('nom_categoria') is-invalid @enderror" name="nom_categoria"
                placeholder="-"
                value="{{ old('nom_categoria', $categoria->nom_categoria) }}">

            @error('nom_categoria')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>

</div>
