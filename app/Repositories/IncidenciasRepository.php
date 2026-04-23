<?php

namespace App\Repositories;

use App\Enums\IncidenciaStatus;
use App\Models\IncidenciasModel;
use Carbon\Carbon;

class IncidenciasRepository
{
    /**
     * Crea una nueva incidencia y la persiste en la base de datos.
     *
     * @param array $value Datos de la incidencia (ordenador_id, titulo, descripcion, etc.).
     * @return void
     */
    public static function createIncidencia($value){
        $fecha = $value['fecha'] ?? Carbon::now()->toDateString();
        $hora = $value['hora'] ?? Carbon::now()->toTimeString();
        
        $status = IncidenciaStatus::tryFrom($value['status'] ?? '') ?? IncidenciaStatus::AVERIADO;

        $incidencia = new IncidenciasModel();
        $incidencia->ordenador_id = $value['ordenador_id'];
        $incidencia->titulo = $value['titulo'];
        $incidencia->descripcion = $value['descripcion'];
        $incidencia->fecha = Carbon::createFromFormat('Y-m-d H:i:s',$fecha.' '.$hora);
        $incidencia->status = $status;
        $incidencia->resuelto = false;
        $incidencia->save();
    }
}
