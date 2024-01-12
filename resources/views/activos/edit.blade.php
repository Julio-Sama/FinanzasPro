@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <form action="{{ route('activos.update', $activo) }}" method="POST">
        @method('PUT')
        @csrf

        <!-- PAGE HEADER -->
        <div class="page-header d-sm-flex d-block">
            <ol class="breadcrumb mb-sm-0 mb-3">
                <!-- breadcrumb -->
                <li class="breadcrumb-item"><a href="{{url('index')}}">Inicio</a></li>
                <li class="breadcrumb-item" aria-current="page">Activos</li>
                <li class="breadcrumb-item active" aria-current="page">Modificar</li>
            </ol><!-- End breadcrumb -->
            <div class="ms-auto">
                <div>
                    <a href="{{ route('activos.index') }}" class="btn btn-primary"><i class="bx bx-arrow-back"></i>
                        Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="bx bx-edit-alt"></i> Modificar</button>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modificar Activo</h3>
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

@endsection
