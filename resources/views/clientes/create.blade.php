@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
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
                        <h3 class="card-title">Nuevo cliente</h3>
                    </div>
                    <div class="card-body">
                        @include('clientes.form')
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
    <script>
        $(document).ready(function () {
            const natural = $('#check_natural');
            const juridico = $('#check_juridico');
            const input_dui = $('#dui_cliente');
            const input_ingreso = $('#ingreso_cliente');
            const input_egreso = $('#egreso_cliente');
            const input_estado_civil = $('#estado_civil_cliente');
            const input_lugar_trabajo = $('#lugar_trabajo_cliente');

            const div_dui = $('#div_dui');
            const div_nit = $('#div_nit');

            const label_ingreso = $('label[for="ingreso_cliente"]');
            const label_egreso = $('label[for="egreso_cliente"]');

            const section_natural = $('#section_natural');

            natural.on('click', function () {
                section_natural.removeClass('d-none');
                input_dui.prop('disabled', false);

                div_nit.addClass('d-none');
                div_dui.removeClass('d-none');

                label_ingreso.text('Ingreso');
                label_egreso.text('Egreso');
            });

            juridico.on('click', function () {
                section_natural.addClass('d-none');
                input_dui.prop('disabled', true);

                div_nit.removeClass('d-none');
                div_dui.addClass('d-none');

                label_ingreso.text('Activo corriente');
                label_egreso.text('Pasivo corriente');

                input_dui.val('');
                input_ingreso.val('');
                input_egreso.val('');
                input_estado_civil.val('');
                input_lugar_trabajo.val('');
            });
        });
    </script>
@endsection
