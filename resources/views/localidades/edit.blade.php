@extends('layouts.base')

@push('styles')

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
        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Hubo algunos errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="mb-0">Editar Localidad</h3>
                <div class="mb-4">
                    <a href="{{ route('localidades.index') }}"><span class="text-muted">Localidades</span></a>
                    <a href="#"><span class="text-muted">/Editar Localidadad</span></a>
                </div>

                <form action="{{ route('localidades.update', $localidad->id_localidad) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nombre de la Localidad -->
                    <div class="form-group">
                        <label for="localidad">Nombre de la Localidad</label>
                        <input type="text" name="localidad" class="form-control" value="{{ old('localidad', $localidad->localidad) }}" required>
                    </div>

                    <!-- Municipio -->
                    <div class="form-group">
                        <label for="id_municipio">Municipio</label>
                        <select name="id_municipio" class="form-control" required>
                            <option value="">Seleccione un municipio</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}" {{ old('id_municipio', $localidad->id_municipio) == $municipio->id_municipio ? 'selected' : '' }}>
                                    {{ $municipio->municipio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div>
                        <a href="{{ route('localidades.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
