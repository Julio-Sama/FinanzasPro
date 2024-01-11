@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form action="{{ route('tipos.store') }}" method="POST">
        @csrf

        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item" aria-current="page">Tipos de activo</li>
                <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('tipos.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
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
                        <h3 class="card-title">Nueva Tipo de activo</h3>
                    </div>
                    <div class="card-body">
                        @include('tipos.form')
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

@endsection
