<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clases y Cursos</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <style>
        .pagination nav .d-sm-flex > div:first-child {
            display: none !important;
        }
        .pagination nav .d-sm-flex {
            justify-content: center !important;
        }
    </style>
</head>
<body class="bg-light">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.incidencias') }}">Panel de Control</a>
        </div>
    </nav>
</header>
<main class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-secondary"><i class="bi bi-tools"></i> Gestión de Incidencias</h2>
        <a href="{{ route('asignaciones.vista') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Panel
        </a>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.incidencias') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="ordenador_id" class="form-label text-secondary small fw-bold"><i class="bi bi-pc-display me-1"></i> Ordenador</label>
                    <select name="ordenador_id" id="ordenador_id" class="form-select">
                        <option value="">Buscar por PC...</option>
                        @if(isset($ordenadores))
                            @foreach($ordenadores as $ordenador)
                                <option value="{{ $ordenador['id'] }}" {{ isset($value['ordenador_id']) ? ($value['ordenador_id'] == $ordenador['id'] ? 'selected' : '') : '' }}>
                                    Nº {{ $ordenador['nombre'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha" class="form-label text-secondary small fw-bold"><i class="bi bi-calendar-date me-1"></i> Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ isset($value['fecha']) ? $value['fecha'] : '' }}">
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label text-secondary small fw-bold"><i class="bi bi-tag me-1"></i> Estado</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Todos los estados</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->value }}" {{ isset($value['status']) ? ($value['status'] == $estado->value ? 'selected' : '') : '' }}>
                                {{ ucfirst(strtolower(str_replace('_', ' ', $estado->name))) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filtrar</button>
                    <a href="{{ route('admin.incidencias') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-eraser"></i> Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white d-flex align-items-center">
            <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Ordenadores con Incidencias Activas</h5>
        </div>
        <div class="card-body p-0">
            @if(isset($incidencias) && count($incidencias) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">PC</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Fecha y hora</th>
                                <th>Estado</th>
                                <th class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($incidencias as $incidencia)
                                    <tr class="table-danger">
                                        <td class="ps-4">
                                            <strong>Nº {{ $incidencia->ordenador_nombre ?? 'Desconocido' }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $incidencia->titulo ?? 'Sin título' }}</strong>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $incidencia->descripcion ?? 'Sin descripción' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $incidencia->fecha ?? 'Sin fecha' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small fw-bold text-secondary">
                                                {{ $incidencia->status->value ?? $incidencia->status->name ?? $incidencia->status ?? 'Desconocido' }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            @php
                                                $statusName = strtolower($incidencia->status->name ?? $incidencia->status ?? '');
                                            @endphp

                                            @if($statusName === 'sin_solucion')
                                                <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Sin solución</span>
                                            @elseif($statusName === 'resuelto' || $incidencia->resuelto)
                                                <span class="badge bg-secondary"><i class="bi bi-info-circle"></i> Reparado</span>
                                            @else
                                                <a href="{{ route('admin.incidencias.cambiar', ['incidencia_id' => $incidencia->id]) }}" 
                                                   class="btn btn-sm {{ $statusName === 'pendiente' ? 'btn-warning' : 'btn-success' }}">
                                                    <i class="bi {{ $statusName === 'pendiente' ? 'bi-tools' : 'bi-check-lg' }}"></i> 
                                                    {{ $statusName === 'pendiente' ? 'Mantenimiento' : 'Reparado' }}
                                                </a>
                                                <a href="{{ route('admin.incidencias.cambiar', ['incidencia_id' => $incidencia->id, 'sin_solucion' => true]) }}" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-x-circle"></i> Sin solución 
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                    <div class="d-flex justify-content-center pt-4 pb-2 border-top pagination">
                        {{ $incidencias->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
            @else
                <div class="p-5 text-center text-muted">
                    @if(request('ordenador_id') || request('fecha') || request('status'))
                        <i class="bi bi-search text-secondary mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-secondary">Sin resultados</h4>
                        <p class="fs-6">No se ha encontrado ninguna incidencia que coincida con los filtros aplicados.</p>
                        <a href="{{ route('admin.incidencias') }}" class="btn btn-outline-secondary mt-3"><i class="bi bi-eraser"></i> Limpiar filtros</a>
                    @else
                        <i class="bi bi-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-success">¡Todo en orden!</h4>
                        <p class="fs-6">No hay ordenadores con incidencias registrados en este momento.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#ordenador_id", {
            create: false,
            placeholder: "Buscar por PC..."
        });
    });
</script>
</body>
</html>