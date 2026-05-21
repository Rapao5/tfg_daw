<?php

namespace App\Services;

use App\Repositories\HistoricoRepository as repoHistorial;

class HistorialService
{
    /**
     * Devuelve un un array formateado para meterlo en una tabla
     * 
     * @param array $data Datos del filtro 
     * @return array
     */
    public function getHistorico($data){
        $datos = repoHistorial::getHistorico($data);
        $tabla = [];

        foreach($datos as $dato){
            $tabla[]=[
                'id' => $dato['id'],
                'valores' =>[
                    $dato['ordenador_nombre'],
                    $dato['alumno_nombre'],
                    $dato['alumno_apellidos'],
                    $dato['curso_nivel'],
                    $dato['curso_letra'],
                    $dato['aula_nombre'],
                    $dato['fecha']
                ]
            ]; 
        }
        return $tabla;
    }

    /**
     * Crea registros en el historial de asignaciones.
     *
     * @param array $value Lista de datos de asignación para persistir.
     * @return bool
     */
    public function historico($value){
        return repoHistorial::createHistorico($value);
    }

}