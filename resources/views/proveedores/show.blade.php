@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form id="form_proveedor">
        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                <li class="breadcrumb-item active" aria-current="page">Ver</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Atrás</a>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ver proveedor</h3>
                    </div>
                    <div class="card-body">
                        @include('proveedores.form')
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script>
        @if($view)
        $(document).ready(function () {
            var form = $('#form_proveedor');
            var inputs = form.find('input');
            var selects = form.find('select');
            var textareas = form.find('textarea');

            inputs.each(function () {
                $(this).prop('disabled', true);
            });

            selects.each(function () {
                $(this).prop('disabled', true);
            });

            textareas.each(function () {
                $(this).prop('disabled', true);
            });
        });
        @endif
    </script>
@endsection
