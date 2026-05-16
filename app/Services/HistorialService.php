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
                    $dato['curso_nombre'],
                    $dato['aula_nombre'],
                    $dato['fecha']
                ]
            ]; 
        }
        return $tabla;
    }
}