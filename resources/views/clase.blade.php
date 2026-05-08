<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clases y Cursos</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('asignaciones.vista') }}">Panel de Control</a>
            

            <div class="collapse navbar-collapse" id="filtrosHeader">
                <form action="{{ route('asignaciones.filtrar') }}" method="GET" class="d-flex ms-auto gap-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Curso</span>
                        <select name="curso_id" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso['id'] }}" {{ (isset($value) && $value['curso_id'] == $curso['id']) ? 'selected' : '' }}>
                                   {{ $curso['nivel'] }}º {{ $curso['letra'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Aula</span>
                        <select name="aula_id" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            @foreach($aulas as $aula)
                                <option value="{{ $aula['id'] }}" {{ (isset($value) && $value['aula_id'] == $aula['id']) ? 'selected' : '' }}>
                                    {{ $aula['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-light btn-sm" type="submit">Filtrar</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-4">
    @if(isset($ordenadores))
    <div class="d-flex justify-content-center p-2">
        <button type="submit" class="btn btn-info btn-lg mb-3 p-3">
            <i class="bi bi-clock-history"></i> Historial
        </button>
    </div>
        <div class="row">
            @foreach ($ordenadores as $item)
                <div class="col-md-3 mb-4">
                    <div class="card text-center border-dark h-100 shadow-sm">
                        <div class="card-header text-white" style="background-color: #0b63a9;">
                            <strong>Ordenador Nº {{ $item['nombre'] ?? $item['nombre_ordenador'] }}</strong>
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
                                        
                                        <select name="alumno_id" class="form-select form-select-sm mb-2" required>
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
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100 mb-2">
                                <i class="bi bi-pc-display"></i> Incidencia
                            </button>
                        </div>

                        <div class="card-footer py-1 bg-light">
                            @if($asignacion)
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
</body>
</html>