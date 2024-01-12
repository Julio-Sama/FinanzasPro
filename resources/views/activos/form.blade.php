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
                    <option value="{{ $tipo->id_tipo }}" data-vida-util="{{ $tipo->vida_util }}"
                        {{ $activo->id_tipo == $tipo->id_tipo ? 'selected' : '' }}>
                        {{ $tipo->nom_tipo }}
                    </option>
                @endforeach
            </select>

            @error('id_tipo')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="id_tipo_error"></div>
                </div>
            @enderror
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

{{-- Tabla para mostrar la depreciación --}}
<div class="row mt-2">
    <div class="col-md-12">
        <h3>Tabla de Depreciación</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Cuota Anual de Depreciación</th>
                </tr>
            </thead>
            <tbody id="depreciationTableBody">
                <!-- Aquí se llenará la tabla mediante JavaScript -->

            </tbody>
        </table>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="monto_total_depreciacion" class="form-label">Monto total de depreciación</label>
                    <input type="text" class="form-control" name="monto_total_depreciacion"
                        id="monto_total_depreciacion" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor_residual" class="form-label">Valor residual</label>
                    <input type="text" class="form-control" name="valor_residual" id="valor_residual" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="comprobacion_valor_original" class="form-label">Comprobación del valor
                        original</label>
                    <input type="text" class="form-control" name="comprobacion_valor_original"
                        id="comprobacion_valor_original" readonly>
                </div>
            </div>
        </div>

    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#id_tipo').change(function() {
                var vidaUtil = $(this).find(':selected').data('vida-util');
                $('#vida_util_activo').val(vidaUtil);

                // Calcular la depreciación y llenar la tabla
            });
            calcularDepreciacion();
        });

        function calcularDepreciacion() {
            var costoCompra = parseFloat($('#costo_compra_activo').val()) || 0;
            var vidaUtil = parseFloat($('#vida_util_activo').val()) || 0;
            var fechaCompra = $('#fech_compra_activo').val();

            // Validar que los valores sean numéricos y positivos
            if (isNaN(costoCompra) || isNaN(vidaUtil) || costoCompra < 0 || vidaUtil <= 0) {
                alert('Por favor, ingrese valores válidos para el costo de compra y la vida útil.');
                return;
            }

            // Desarrollo de la fórmula
            var valorResidual = costoCompra * 0.10;
            var valorADepreciar = costoCompra - valorResidual;
            var cuotaAnualDepreciacion = valorADepreciar / vidaUtil;
            var cuotaDiariaDepreciacion = cuotaAnualDepreciacion / 365;

            // Convertir la fecha de compra a un objeto de fecha
            var fechaCompraDate = new Date(fechaCompra);

            // Calcular los días hasta fin de año desde la fecha de compra
            var endOfYear = new Date(fechaCompraDate.getFullYear(), 11, 31);
            var diasHastaFinDeAnio = Math.round((endOfYear - fechaCompraDate) / (24 * 60 * 60 * 1000));

            // Calcular la depreciación hasta fin de año
            var depreciacionHastaFinDeAnio = cuotaDiariaDepreciacion * diasHastaFinDeAnio;

            // Llenar la tabla con los resultados
            $('#depreciationTableBody').empty();
            var totalDepreciacion = 0;

            for (var i = 1; i <= vidaUtil; i++) {
                var montoDepreciacion = i === 1 ? depreciacionHastaFinDeAnio.toFixed(2) : cuotaAnualDepreciacion.toFixed(2);
                totalDepreciacion += parseFloat(montoDepreciacion);

                $('#depreciationTableBody').append(
                    '<tr>' +
                    '<td>' + (fechaCompraDate.getFullYear() + i - 1) + '</td>' +
                    '<td>' + montoDepreciacion + '</td>' +
                    '</tr>'
                );
            }

            // calcular depreciacion total hasta el fin de año
            var depreciacionTotalHastaFinDeAnio = cuotaAnualDepreciacion * vidaUtil;

            // calcular la depreciacion del ultimo año
            var montoFinalYear = depreciacionTotalHastaFinDeAnio - totalDepreciacion;
            if (montoFinalYear < 0) {
                montoFinalYear = 0;
            }

            // Agregar la fila de "Sexto año" con el monto restante
            $('#depreciationTableBody').append(
                '<tr>' +
                '<td>Año final</td>' +
                '<td>' + montoFinalYear.toFixed(2) + '</td>' +
                '</tr>'
            );

            // Mostrar el valor residual y la comprobación
            $('#valor_residual').val(valorResidual.toFixed(2));
            $('#comprobacion_valor_original').val(costoCompra.toFixed(2));
            $('#monto_total_depreciacion').val((totalDepreciacion + montoFinalYear).toFixed(2));
        }
    </script>
@endsection
