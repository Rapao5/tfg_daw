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
            <a class="navbar-brand" href="{{ route('asignaciones.vista') }}">Panel de Control</a>
            

            <div class="collapse navbar-collapse" id="filtrosHeader">
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4" style="min-height: 50vh;">
        
        <a href="#" class="btn btn-danger btn-lg p-5 fs-3 shadow-sm rounded-4 d-flex flex-column align-items-center justify-content-center" style="width: 300px; height: 250px;">
            <i class="bi bi-pc-display mb-2" style="font-size: 3rem;"></i> 
            Ver incidencias
        </a>

        <a href="#" class="btn btn-primary btn-lg p-5 fs-3 shadow-sm rounded-4 d-flex flex-column align-items-center justify-content-center" style="width: 300px; height: 250px;">
            <i class="bi bi-clock-history mb-2" style="font-size: 3rem;"></i>
            Historial
        </a>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>