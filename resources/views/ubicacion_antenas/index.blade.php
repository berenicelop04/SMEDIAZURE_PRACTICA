@extends('layouts.base')

@section('navbar')
  @include('layouts.navbar')
@endsection

@section('sidebar')
  @include('layouts.sidebar')
@endsection

  {{-- Contenido principal --}}
  @section('content')
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Listado de Localidades</h2>
              </div>
            </div>

            <div class="card shadow">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table datatables table-striped">
                    <thead>
                        <tr>
                            <th>ID Antena</th>
                            <th>Localidad</th>
                            <th>Municipio</th>
                            <th>Estado Energía</th>
                            <th>Dispositivo</th>
                            <th>IP</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($antenas as $antena)
                            <tr>
                            <td>{{ $antena->id_antena }}</td>
                            <td>{{ $antena->localidad->localidad ?? 'N/A' }}</td>
                            <td>{{ $antena->municipio->municipio ?? 'N/A' }}</td>
                            <td>{{ $antena->estadoEnergia->estado_energia ?? 'N/A' }}</td>
                            <td>{{ $antena->dispositivo->modelo ?? 'N/A' }}</td>
                            <td>{{ $antena->ip }}</td>
                            <td>{{ $antena->latitud }}</td>
                            <td>{{ $antena->longitud }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
  @endsection
