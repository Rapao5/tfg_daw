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
<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('') }}">Panel de Control</a>
              <span class="navbar-text text-white-50 ms-auto"><i class="bi bi-tools me-2"></i>Registro de Incidencia</span>
        </div>
    </nav>
</header>
<body class="bg-light">
<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mb-10">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #dc3545;">
                    <h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Registrar Nueva Incidencia</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('incidencias.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="curso_id" class="form-label"><i class="bi bi-mortarboard me-2"></i>Curso</label>
                                <select class="form-select @error('curso_id') is-invalid @enderror" id="curso_id" name="curso_id" required>
                                    <option value="">Seleccionar curso...</option>
                                    @isset($cursos)
                                        @foreach($cursos as $curso)
                                            <option value="{{ $curso['id'] }}" {{ old('curso_id') == $curso['id'] ? 'selected' : '' }}>
                                                {{ $curso['nivel'] }}º {{ $curso['letra'] }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">No hay cursos disponibles</option>
                                    @endisset
                                </select>
                                @error('curso_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="fecha" class="form-label"><i class="bi bi-calendar-date me-2"></i>Día</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="hora" class="form-label"><i class="bi bi-clock me-2"></i>Hora</label>
                                <input type="time" class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora" value="{{ old('hora', date('H:i')) }}" required>
                                @error('hora')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label"><i class="bi bi-chat-left-text me-2"></i>Descripción de la Incidencia</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5" placeholder="Describe brevemente el problema con el ordenador..." required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('asignaciones.vista') }}" class="btn btn-secondary"><i class="bi bi-x-lg me-2"></i>Cancelar</a>
                            <button type="submit" class="btn btn-danger"><i class="bi bi-send-fill me-2"></i>Registrar Incidencia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>