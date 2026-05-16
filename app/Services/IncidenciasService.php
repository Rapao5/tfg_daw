<?php

namespace App\Services;

use App\Repositories\IncidenciasRepository;

use App\Enums\IncidenciaStatus;
class IncidenciasService
{
    public function create($value){
        return  IncidenciasRepository::createIncidencia($value);
    }  
    
    public function getIncidencias($value){
        $datos = IncidenciasRepository::getIncidencias($value);
        $tabla = [];

        foreach($datos as $dato){
            $tabla[]=[
                'id' => $dato['id'],
                'valores' =>[
                    $dato['ordenador_nombre'],
                    $dato['titulo'],
                    $dato['descripcion'],
                    $dato['fecha'],
                    $dato['status'],
                    $dato['resuelto']
                ]
            ]; 
        }
        return $tabla;
    }

    public function cambiarEstado($incidencia_id, $sin_solucion = false){
        $incidencia = IncidenciasRepository::getIncidencia($incidencia_id);

        if ($incidencia) {
            $incidencia->status = match ($incidencia->status) {
                IncidenciaStatus::PENDIENTE     => IncidenciaStatus::MANTENIMIENTO,
                IncidenciaStatus::MANTENIMIENTO => $sin_solucion ? IncidenciaStatus::SIN_SOLUCION : IncidenciaStatus::RESUELTO,
                default                         => $incidencia->status,
            };

            $incidencia->save();
        }
    }
}
