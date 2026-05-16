<?php

namespace App\Services;

use App\Repositories\IncidenciasRepository;

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
}
