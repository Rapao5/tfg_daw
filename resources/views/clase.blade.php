<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clases y Cursos</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('asignaciones.vista') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="110" height="75" class="me-2 rounded">
                Gestor de ordenadores
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filtrosHeader" aria-controls="filtrosHeader" aria-expanded="false" aria-label="Navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="filtrosHeader">
                <form action="{{ route('asignaciones.filtrar') }}" method="GET" class="d-flex flex-column flex-lg-row ms-auto gap-3 align-items-stretch align-items-lg-center mt-3 mt-lg-0">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 w-100">
                        <label class="text-white mb-0" style="font-weight: 500; min-width: 55px;">Curso:</label>
                        <div class="w-100" style="min-width: 150px;">
                            <select name="curso_id" class="form-select form-select-sm searchable-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso['id'] }}" {{ (isset($value) && $value['curso_id'] == $curso['id']) ? 'selected' : '' }}>
                                       {{ $curso['nivel'] }}º {{ $curso['letra'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 w-100">
                        <label class="text-white mb-0" style="font-weight: 500; min-width: 55px;">Aula:</label>
                        <div class="w-100" style="min-width: 150px;">
                            <select name="aula_id" class="form-select form-select-sm searchable-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach($aulas as $aula)
                                    <option value="{{ $aula['id'] }}" {{ (isset($value) && $value['aula_id'] == $aula['id']) ? 'selected' : '' }}>
                                        {{ $aula['nombre'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-light btn-sm mt-2 mt-lg-0" type="submit">Filtrar</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<main class="container mt-4">
    <p class="text-center">¡IMPORTANTE! Guardar siempre que se hayan asignado los alumnos.</p>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($ordenadores))
    <div class="d-flex justify-content-center p-2">
        <form action="{{ route('asignaciones.historial') }}" method="POST">
            @csrf
            <input type="hidden" name="curso_id" value="{{ $value['curso_id'] }}">
            <input type="hidden" name="aula_id" value="{{ $value['aula_id'] }}">
            <button type="submit" class="btn btn-info btn-lg mb-3 p-3">
                <i class="bi bi-clock-history"></i> Guardar
            </button>
        </form>
    </div>
        <div class="row">
            @foreach (collect($ordenadores)->sortBy('nombre', SORT_NATURAL) as $item)
                <div class="col-md-3 mb-4">
                    <div class="card text-center border-dark h-100 shadow-sm">
                        <div class="card-header text-white" style="background-color: #0b63a9;">
                            <strong>Ordenador Nº {{ $item['nombre'] }}</strong>
                        </div>

                        @php
                            $asignacion = collect($asignaciones)->firstWhere('ordenador_id', $item['id']);
                        @endphp

                        <div class="card-body d-flex flex-column justify-content-center">
                            @if($asignacion)
                                <h5 class="card-title text-primary">{{ $asignacion['nombre_alumno'] }} {{ $asignacion['apellido_alumno'] }}</h5>
                                <p class="card-text text-muted"></p>

                                <form action="{{ route('asignaciones.miniBorrar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="asignacion_id" value="{{ $asignacion['asignacion_id'] }}">
                                    <input type="hidden" name="curso_id" value="{{ $value['curso_id'] }}">
                                    <input type="hidden" name="aula_id" value="{{ $value['aula_id'] }}">

                                    
                                    <button type="submit" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                        <i class="bi bi-person-x"></i> Liberar PC
                                    </button>
                                </form>
                            @else
                                @if(empty($alumnos))
                                    <p class="text-muted small">No hay alumnos disponibles</p>
                                @else
                                    <form action="{{ route('asignaciones.miniCrear') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="ordenador_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="curso_id" value="{{ $value['curso_id'] }}">
                                        <input type="hidden" name="aula_id" value="{{ $value['aula_id'] }}">
                                        
                                        <select name="alumno_id" class="form-select form-select-sm mb-2 searchable-select" required>
                                            <option value="">Asignar alumno...</option>
                                            @foreach($alumnos as $alumno)
                                                <option value="{{ $alumno['id'] }}">
                                                    {{ $alumno['nombre'] ?? 'Alumno' }} {{ $alumno['apellidos'] ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                        <button type="submit" class="btn btn-outline-success btn-sm w-100 mb-2">
                                            <i class="bi bi-person-plus"></i> Asignar PC
                                        </button>
                                    </form>
                                @endif
                            @endif
                            <a href="{{ route('incidencias.home', ['ordenador_id' => $item['id'], 'curso_id' => $value['curso_id'], 'aula_id' => $value['aula_id']]) }}" class="btn btn-outline-danger btn-sm w-100 mb-2">
                                <i class="bi bi-pc-display"></i> Incidencia
                            </a>
                        </div>

                        <div class="card-footer py-1 bg-light">
                            @if($item['disponible'] == false)
                                <small class="text-danger">● Averiado</small>
                            @elseif($asignacion)
                                <small class="text-danger">● Ocupado</small>
                            @else
                                <small class="text-success">● Disponible</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center mt-5">
            <i class="bi bi-info-circle"></i> Selecciona un curso y un aula para gestionar los ordenadores.
        </div>
    @endif
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.searchable-select').forEach(function(el) {
            new TomSelect(el, {
                create: false
            });
        });
    });
</script>
</body>
</html>