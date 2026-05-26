<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asignaciones</title>
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
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
</head>
<body class="bg-light">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-4" style="background-color: #0b63a9;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.historial') }}">Panel de Control</a>
            <a href="{{ route('asignaciones.vista') }}" class="btn btn-outline-light">
                <i class="bi bi-arrow-left"></i> Volver al Panel
            </a>
        </div>
    </nav>
</header>
<main class="container mt-5 mb-5">
    <h2 class="mb-4 text-secondary"><i class="bi bi-clock-history"></i> Historial de Asignaciones</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.historial') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label text-secondary small fw-bold">Desde Fecha</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ data_get($data, 'fecha_inicio') }}">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label text-secondary small fw-bold">Hasta Fecha</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ data_get($data, 'fecha_fin') }}">
                </div>
                <div class="col-md-3">
                    <label for="ordenador_id" class="form-label text-secondary small fw-bold">Ordenador</label>
                    <select name="ordenador_id" id="ordenador_id" class="form-select">
                        <option value="">Cualquier ordenador</option>
                        @foreach($ordenadores ?? [] as $ordenador)
                            <option value="{{ $ordenador['id'] }}" {{ data_get($data, 'ordenador_id') == $ordenador['id'] ? 'selected' : '' }}>Nº {{ $ordenador['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="alumno_id" class="form-label text-secondary small fw-bold">Alumno</label>
                    <select name="alumno_id" id="alumno_id" class="form-select">
                        <option value="">Cualquier alumno</option>
                        @foreach($alumnos ?? [] as $alumno)
                            <option value="{{ $alumno['id'] }}" {{ data_get($data, 'alumno_id') == $alumno['id'] ? 'selected' : '' }}>{{ $alumno['apellidos'] }}, {{ $alumno['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="aula_id" class="form-label text-secondary small fw-bold">Aula</label>
                    <select name="aula_id" id="aula_id" class="form-select">
                        <option value="">Cualquier aula</option>
                        @foreach($aulas ?? [] as $aula)
                            <option value="{{ $aula['id'] }}" {{ data_get($data, 'aula_id') == $aula['id'] ? 'selected' : '' }}>{{ $aula['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cursos_id" class="form-label text-secondary small fw-bold">Curso</label>
                    <select name="cursos_id" id="cursos_id" class="form-select">
                        <option value="">Cualquier curso</option>
                         @foreach($cursos ?? [] as $curso)
                            <option value="{{ $curso['id'] }}" {{ data_get($data, 'cursos_id') == $curso['id'] ? 'selected' : '' }}>{{ $curso['nivel'] }} {{ $curso['letra'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filtrar</button>
                    <a href="{{ route('admin.historial') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-eraser"></i> Limpiar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if(isset($historial) && count($historial) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabla_historial">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Ordenador</th>
                                <th>Alumno</th>
                                <th>Curso</th>
                                <th>Aula</th>
                                <th>Profesor</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historial as $registro)
                                <tr>
                                    <td class="ps-4"><strong>Nº {{ data_get($registro, 'ordenador.nombre') ?? data_get($registro, 'ordenador_nombre') ?? 'Desconocido' }}</strong></td>
                                    <td>{{ data_get($registro, 'alumno.apellidos') ?? data_get($registro, 'alumno.apellido') ?? data_get($registro, 'alumno_apellido') ?? data_get($registro, 'alumno_apellidos') ?? '' }} {{ data_get($registro, 'alumno.nombre') ?? data_get($registro, 'alumno_nombre') ?? '' }}</td>
                                    <td>{{ data_get($registro, 'curso.nivel') ?? data_get($registro, 'curso_nivel') ?? '' }} {{ data_get($registro, 'curso.letra') ?? data_get($registro, 'curso_letra') ?? '' }}</td>
                                    <td>{{ data_get($registro, 'aula.nombre') ?? data_get($registro, 'aula_nombre') ?? 'Desconocido' }}</td>
                                    <td>{{ data_get($registro, 'profesor') ?? 'Sin profesor' }}</td>
                                    <td>
                                        @if($date = data_get($registro, 'created_at') ?? data_get($registro, 'fecha'))
                                            {{ \Carbon\Carbon::parse($date)->format('d/m/Y H:i') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <div class="d-flex justify-content-center pt-4 pb-2 border-top pagination">
                        {{ $historial->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
            @else
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-search text-secondary mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-secondary">Sin resultados</h4>
                    <p>No se encontraron registros en el historial con los filtros aplicados.</p>
                    <a href="{{ route('admin.historial') }}" class="btn btn-outline-secondary mt-3"><i class="bi bi-eraser"></i> Limpiar filtros</a>
                </div>
            @endif
        </div>
    </div>
</main>

<button id="exportar-excel" class="btn btn-outline-primary">Exportar a excel</button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ['#ordenador_id', '#alumno_id', '#aula_id', '#cursos_id'].forEach(id => {
            new TomSelect(id, { create: false, placeholder: "Buscar..." });
        });
    });

    
    document.getElementById("exportar-excel").addEventListener("click", function(){
        console.log("Exportando a Excel...");
        
        var tabla = document.getElementById("tabla_historial");
        if (!tabla) {
            console.error("Error: No se encontró ningún elemento con el ID 'tabla_historial'.");
            alert("No hay datos disponibles para exportar.");
            return;
        }
        var wb = XLSX.utils.table_to_book(tabla, { sheet: "Hoja1", raw: false });

        XLSX.writeFile(wb, "historial_exportado.xlsx");
    });
</script>
</body>
</html>