<?php

use App\Http\Controllers\AsignacionesOrdenadorController;
use App\Http\Controllers\IncidenciasController;
use App\Http\Controllers\HistorialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()-> route('asignaciones.vista');
});

// Rutas para visualizar las clases
Route::get('/asignaciones/filtrar', [AsignacionesOrdenadorController::class, 'filtrar'])->name('asignaciones.filtrar');
Route::get("/asignaciones", [AsignacionesOrdenadorController::class, "vista"])->name('asignaciones.vista');

// Rutas para mini crear
Route::post("/asignaciones/crear", [AsignacionesOrdenadorController::class, 'miniCrear'])->name("asignaciones.miniCrear");

// Rutas para mini borrar
Route::post("/asignaciones/borrar", [AsignacionesOrdenadorController::class, 'miniBorrar'])->name('asignaciones.miniBorrar');

// Ruta para añadir al historial
Route::post('/asignaciones/historial', [AsignacionesOrdenadorController::class, 'historico'])->name('asignaciones.historial');

// Rutas para incidencias
Route::get('/incidencias', [IncidenciasController::class, 'home'])->name('incidencias.home');
Route::post('/incidencias', [IncidenciasController::class, 'create'])->name('incidencias.create');

// Rutas para incidencias de admin
Route::get('/admin/incidencias', [IncidenciasController::class, 'homeAdmin'])->name('admin.incidencias');
Route::get('/admin/incidencias/{incidencia_id}', [IncidenciasController::class, 'cambiarEstado'])->name('admin.incidencias.cambiar');

// Rutas para ver historial
Route::get('/admin/historial', [HistorialController::class, 'home'])->name('admin.historial');

Route::post('/admin/incidencias/quitar', [IncidenciasController::class, 'quitar'])->name('incidencias.quitar');
