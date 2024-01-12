@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <form action="{{ route('activos.store') }}" method="POST" id="form_activo">
        @csrf
        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{ url('index') }}">Inicio</a></li>
                <li class="breadcrumb-item" aria-current="page">Activos</li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('activos.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Registrar</button>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo activo</h3>
                    </div>
                    <div class="card-body">
                        @include('activos.form')
                    </div>
                    <div class="card-footer">
                        Los campos con (*) son obligatorios.
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script src="{{ asset('build/assets/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        // cod_activo, descrip_activo, marca_activo, modelo_activo, serie_activo,
        // color_activo, fecha_compra_activo, vida_util_activo, costo_compra_activo, estado_activo, id_tipo.
        const cod_activo = $('#cod_activo');
        const descrip_activo = $('#descrip_activo');
        const marca_activo = $('#marca_activo');
        const modelo_activo = $('#modelo_activo');
        const serie_activo = $('#serie_activo');
        const color_activo = $('#color_activo');
        const fecha_compra_activo = $('#fech_compra_activo');
        const vida_util_activo = $('#vida_util_activo');
        const costo_compra_activo = $('#costo_compra_activo');
        const estado_activo = $('#estado_activo');

        const input_vida_util = document.querySelector('[name="vida_util_activo"]');

        let tipo_activo_seleccionado = null;



        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // Eliminar errores de validacion
            $('input').on('keyup', function() {
                $(this).removeClass('is-invalid');
            });

            $('select').on('change', function() {
                $(this).removeClass('is-invalid');
            });


        });
    </script>
@endsection
