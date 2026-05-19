<?php

namespace App\Services;

use App\Repositories\IncidenciasRepository;
use App\Repositories\OrdenadoresRepository as repoOrdenadores;

use App\Enums\IncidenciaStatus;
class IncidenciasService
{
    public function create($value){
        return  IncidenciasRepository::createIncidencia($value);
    }  
    
    public function getIncidencias($value){
        return IncidenciasRepository::getIncidencias($value);
    }

    public function cambiarEstado($incidencia_id, $sin_solucion = false){
        $incidencia = IncidenciasRepository::getIncidencia($incidencia_id);
        if($incidencia){
            switch($incidencia->status){
                case IncidenciaStatus::PENDIENTE:
                    $incidencia->status = $sin_solucion ? IncidenciaStatus::SIN_SOLUCION : IncidenciaStatus::MANTENIMIENTO;
                    $sin_solucion ? $incidencia->resuelto = true : null;
                    break;
                case IncidenciaStatus::MANTENIMIENTO:
                    $incidencia->status = $sin_solucion ? IncidenciaStatus::SIN_SOLUCION : IncidenciaStatus::RESUELTO;
                    $incidencia->resuelto = true;
                    if($sin_solucion){
                        repoOrdenadores::marcarDeshabilitado($incidencia->ordenador_id);
                    } else {
                        repoOrdenadores::comprobarEstado($incidencia->ordenador_id);
                    }
                    break;
                default:
                    break;
                
            }
            $incidencia->save();
        }
    }
}