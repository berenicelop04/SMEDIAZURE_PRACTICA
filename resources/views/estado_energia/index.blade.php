<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
  <title>SMEDI</title>

  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
  
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- Icons CSS -->
  <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
  <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
  
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
  
  <!-- App CSS -->
  <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
  <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
</head>

<body class="vertical light">
  <div class="wrapper">

    {{-- Navbar superior --}}
    @include('layouts.navbar')

    {{-- Sidebar lateral --}}
    @include('layouts.sidebar')

    {{-- Contenido principal --}}
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Welcome!</h2>
              </div>
              <div class="col-auto">
                <form class="form-inline">
                  <div class="form-group d-none d-lg-inline">
                    <label for="reportrange" class="sr-only">Date Ranges</label>
                    <div id="reportrange" class="px-2 py-2 text-muted">
                      <span class="small"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                    <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="card-body">
            <!-- table -->
            <div id="dataTable-1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable-1_length"><label><font _mstmutation="1" _msttexthash="97786" _msthash="83">Mostrar </font><select name="dataTable-1_length" aria-controls="dataTable-1" class="custom-select custom-select-sm form-control form-control-sm"><option value="16" _msttexthash="10075" _msthash="84">16</option><option value="32" _msttexthash="9841" _msthash="85">32</option><option value="64" _msttexthash="10322" _msthash="86">64</option><option value="-1" _msttexthash="29783" _msthash="87">Todo</option></select><font _mstmutation="1" _msttexthash="112905" _msthash="88"> Entradas</font></label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable-1_filter" class="dataTables_filter"><label><font _mstmutation="1" _msttexthash="85956" _msthash="89">Buscar:</font><input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable-1"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table datatables dataTable no-footer" id="dataTable-1" role="grid" aria-describedby="dataTable-1_info">
            <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="dataTable-1" rowspan="1" colspan="1" aria-label="#: activar para ordenar la columna ascendente" _mstaria-label="941499" _msthash="91" style="width: 9.5625px;">#</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable-1" rowspan="1" colspan="1" aria-label="Nombre: activar para ordenar la columna de forma ascendente" _mstaria-label="1105559" _msthash="92" _msttexthash="76193" style="width: 69.5469px;">Estado Energia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estados as $estado)
                <tr role="row" class="odd">
                    <td>{{ $estado->id_estado_energia }}</td>
                    <td>{{ $estado->estado_energia }}</td>
                </tr>
            @endforeach
            </tbody>
            </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable-1_info" role="status" aria-live="polite" _msttexthash="750360" _msthash="292">Mostrando del 1 al 16 de 63 entradas</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable-1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTable-1_previous"><a href="#" aria-controls="dataTable-1" data-dt-idx="0" tabindex="0" class="page-link" _msttexthash="116246" _msthash="293">Anterior</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable-1" data-dt-idx="1" tabindex="0" class="page-link" _msttexthash="4459" _msthash="294">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable-1" data-dt-idx="2" tabindex="0" class="page-link" _msttexthash="4550" _msthash="295">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable-1" data-dt-idx="3" tabindex="0" class="page-link" _msttexthash="4641" _msthash="296">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable-1" data-dt-idx="4" tabindex="0" class="page-link" _msttexthash="4732" _msthash="297">4</a></li><li class="paginate_button page-item next" id="dataTable-1_next"><a href="#" aria-controls="dataTable-1" data-dt-idx="5" tabindex="0" class="page-link" _msttexthash="113945" _msthash="298">Próximo</a></li></ul></div></div></div></div>
        </div>

    </main> <!-- main -->
  </div> <!-- .wrapper -->

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/simplebar.min.js') }}"></script>
  <script src="{{ asset('js/daterangepicker.js') }}"></script>
  <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
  <script src="{{ asset('js/tinycolor-min.js') }}"></script>
  <script src="{{ asset('js/config.js') }}"></script>
  <script src="{{ asset('js/d3.min.js') }}"></script>
  <script src="{{ asset('js/topojson.min.js') }}"></script>
  <script src="{{ asset('js/datamaps.all.min.js') }}"></script>
  <script src="{{ asset('js/datamaps-zoomto.js') }}"></script>
  <script src="{{ asset('js/datamaps.custom.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
  </script>
  <script src="{{ asset('js/gauge.min.js') }}"></script>
  <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('js/apexcharts.custom.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script src="{{ asset('js/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
  <script src="{{ asset('js/dropzone.min.js') }}"></script>
  <script src="{{ asset('js/uppy.min.js') }}"></script>
  <script src="{{ asset('js/quill.min.js') }}"></script>
  <script src="{{ asset('js/apps.js') }}"></script>

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>
</body>
</html>
