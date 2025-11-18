@extends('layouts.base')

@push('styles')
  <style>
    .form-label-static {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .form-control-static {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: .375rem;
        padding: 0.5rem 0.75rem;
        color: #495057;
    }
  </style>
@endpush

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('sidebar')
  @include('layouts.sidebar')
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-start mt-0">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="mb-0">Detalles de la Localidad</h3>
                <div class="mb-4">
                    <a href="{{ route('localidades.index') }}"><span class="text-muted">Localidades</span></a>
                    <a href="#"><span class="text-muted">/Ver Localidad</span></a>
                </div>

                <!-- Nombre de la localidad -->
                <div class="form-group mb-3">
                    <label class="form-label-static">Nombre de la Localidad</label>
                    <div class="form-control-static">{{ $localidad->localidad }}</div>
                </div>

                <!-- Municipio asociado -->
                <div class="form-group mb-3">
                    <label class="form-label-static">Municipio</label>
                    <div class="form-control-static">
                        {{ $localidad->municipio->municipio ?? 'N/A' }}
                    </div>
                </div>

                <!-- Botón regresar -->
                <div class="mt-4">
                    <a href="{{ route('localidades.index') }}" class="btn btn-outline-primary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
