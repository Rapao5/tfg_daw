<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clases y Cursos</title>
    <link rel="stylesheet" href="app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('claseAlumno.vista') }}">Panel de Control</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filtrosHeader">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="filtrosHeader">
                    <form action="{{ route('claseAlumno.filtrar') }}" method="GET" class="d-flex ms-auto gap-2">
                        @csrf 
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Curso</span>
                            <select name="curso_id" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ isset($value)? $value['curso_id'] == $curso->id ? 'selected' : '' : "" }}>
                                        {{ $curso->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Clase</span>
                            <select name="clase_id" class="form-select">
                                <option value="">Seleccionar...</option>
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}" {{ isset($value)? $value['clase_id'] == $clase->id ? 'selected' : '' : "" }}>
                                        {{ $clase->nombre }}
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
    @if(isset($ordenadores))
        <div class="container mt-4">
            <div class="row">
                @foreach ($ordenadores as $item)
                    <div class="col-md-3 mb-3">
                        <div class="card text-center border-dark">
                            <div class="card-header text-white" style="background-color: #0b63a9;">
                                <strong>Ordenador Nº{{ $item->nombre_ordenador }}</strong>
                            </div>
                                @php
                                    $asignacion = $claseAlumno->firstWhere('id', $item->id);
                                @endphp
                                @if($asignacion)
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $asignacion->nombre_alumno }} {{ $asignacion->apellido_alumno }}</h5>
                                    </div>
                                    <form action="{{ route('claseAlumno.miniBorrar', ['clase_alumno_curso_id' => $asignacion->cac_id, 'curso_id'  => $value['curso_id'], 'clase_id'  => $value['clase_id']]) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-person-x"></i> Liberar PC
                                        </button>
                                    </form>
                                    <br>
                                    <div class="text-center">
                                        <a href="" class="btn btn-outline-warning text-decoration-none btn-sm" style="width: 130px;">Reportar incidencia <i class="bi bi-display"></i></a>
                                    </div>
                                    </br>
                                    <div class="card-footer py-1">
                                        <small class="text-danger">● Ocupado</small>
                                    </div>
                                @else
                                    @if($alumnos->isEmpty())
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        </div>
                                        <p class="text-muted small mt-2">No hay alumnos disponibles</p>
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <div class="text-center">
                                            <a href="" class="btn btn-outline-warning text-decoration-none btn-sm" style="width: 130px;">Reportar incidencia <i class="bi bi-display"></i></a>
                                        </div>
                                        <br>
                                        </div>
                                    @else
                                    <form action="{{ route('claseAlumno.miniCrear', ['ordenador_clase_id' => $item->id, 'curso_id' => $value['curso_id'], 'clase_id' => $value['clase_id']]) }}" method="POST" class="mt-2">
                                        @csrf    
                                        <select name="alumno_curso_id" class="form-select">
                                            @foreach($alumnos as $alumno)
                                            <option value="{{ $alumno->id }}" {{ isset($alumno)? $alumno['alumno_id'] == $alumno->id ? 'selected' : '' : "" }}>
                                                {{ $alumno->alumno->nombre }} {{ $alumno->alumno->apellido }}
                                            </option>
                                        @endforeach
                                        </select>
                                        </br>
                                        <button type="submit" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-person"></i> Asignar PC
                                        </button>
                                    </form>
                                    </br>
                                        <div class="text-center">
                                            <a href="" class="btn btn-outline-warning text-decoration-none btn-sm" style="width: 130px;">Reportar incidencia <i class="bi bi-display"></i></a>
                                        </div>
                                    </br>
                                    @endif
                                    <div class="card-footer py-1">
                                        <small class="text-success">● Disponible</small>
                                    </div>
                                    
                                @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>