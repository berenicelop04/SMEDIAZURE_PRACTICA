<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMEDI - Monitoreo de Enlaces</title>
    
    <!-- Styles (originales sin cambios) -->
    <link href="{{ asset('css/simplebar.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/feather.css') }}" rel="stylesheet">
    <style>
        /* SOLO AGREGADO: Estilo para el fondo */
        body {
            background: url("{{ asset('img/login/imagen_logo.png') }}") no-repeat center center fixed;
            background-size: cover;
        }
        /* Mantengo tus estilos originales del botón */
        .login-btn {
            background-color: #2A5C8A !important;
            border-color: #1E4A6D !important;
            color: white !important;
        }
        .login-btn:hover {
            background-color: #1E4A6D !important;
            transform: translateY(-1px);
        }
    </style>
    <link href="{{ asset('css/app-light.css') }}" rel="stylesheet">
</head>
<!-- Body original sin cambios en clases -->
<body class="light">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <!-- Columna izquierda (original) -->
            <div class="col-lg-6 d-none d-lg-flex" style="background: rgba(0, 0, 0, 0.5);"> <!-- Solo agregué overlay oscuro -->
                <div class="p-5 text-white">
                    <h2 class="display-4 font-weight-bold">Sistema de Monitoreo</h2>
                    <p class="lead">Comunidades de Bacalar</p>
                </div>
            </div>
            
            <!-- Columna derecha (original SIN CAMBIOS) -->
            <div class="col-lg-6">
                <div class="w-75 mx-auto">
                    <!-- Card original -->
                    <div class="card shadow-sm border-0" style="border-top: 3px solid #2A5C8A !important;">
                        <div class="card-body p-5">
                            <!-- Logo SMEDI original -->
                            <div class="text-center mb-4">
                                <img src="{{ asset('img/login/logo_smedi.jpg') }}" alt="SMEDI Logo" style="height: 70px; width: auto;">
                            </div>
                            
                            <h2 class="h5 text-center mb-4">Acceso al Sistema</h2>
                            
                            @if($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Formulario original -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Correo electrónico</label>
                                    <input type="email" id="email" name="email" 
                                           class="form-control form-control-lg"
                                           value="{{ old('email') }}" required autofocus>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" id="password" name="password" 
                                           class="form-control form-control-lg" required>
                                </div>
                                
                                
                                <!-- Botón original con clases que ya te gustan -->
                                <button type="submit" class="btn btn-lg btn-block login-btn py-2 mb-3">
                                    <i class="fe fe-log-in mr-2"></i> Ingresar
                                </button>
                                
                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #2A5C8A;">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    
                    <!-- Footer original -->
                    <div class="text-center mt-3">
                        <p class="text-muted small">SMEDI © {{ date('Y') }} - Monitoreo de enlaces</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts originales -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.min.js') }}"></script>
</body>
</html>