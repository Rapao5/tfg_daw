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
<body class="bg-light">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.incidencias') }}">Panel de Control</a>
        </div>
    </nav>
</header>
<main class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-secondary"><i class="bi bi-tools"></i> Gestión de Incidencias</h2>
        <a href="{{ route('asignaciones.vista') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Panel
        </a>
    </div>
    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white d-flex align-items-center">
            <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Ordenadores con Incidencias Activas</h5>
        </div>
        <div class="card-body p-0">
            @if(!empty($incidencias))
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
                                            <strong>Nº {{ $incidencia['valores'][0] ?? 'Desconocido' }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $incidencia['valores'][1] ?? 'Sin título' }}</strong>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $incidencia['valores'][2] ?? 'Sin descripción' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{ $incidencia['valores'][3] ?? 'Sin fecha' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small fw-bold text-secondary">
                                                {{ $incidencia['valores'][4]?->value ?? $incidencia['valores'][4]?->name ?? 'Desconocido' }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            @if(!$incidencia['valores'][5] && $incidencia['valores'][4]?->name !== 'RESUELTO' && strtoupper($incidencia['valores'][4]?->value ?? '') !== 'REPARADO')
                                                <form action="{{ route('incidencias.quitar') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="incidencia_id" value="{{ $incidencia['id'] }}">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-lg"></i> Marcar como Reparado
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-secondary"><i class="bi bi-info-circle"></i> Ya reparado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-success">¡Todo en orden!</h4>
                    <p class="fs-6">No hay ordenadores con incidencias registrados en este momento.</p>
                </div>
            @endif
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>