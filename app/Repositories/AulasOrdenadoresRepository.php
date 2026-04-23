<?php

namespace App\Repositories;

use App\Models\AulasOrdenadoresModel as AulasOrdenadores;

class AulasOrdenadoresRepository
{
    /**
     * Obtiene el listado de ordenadores asociados a un aula específica.
     *
     * @param int|string $value ID del aula.
     * @return array|null Lista de ordenadores o null si el aula no tiene ordenadores.
     */
    public static function getOrdenadores($value){
        $query = AulasOrdenadores::select(
            'o.nombre as nombre', 
            'o.id as id',
            'o.disponible as disponible'
            )
        ->join('ordenadores as o', 'aulas_ordenadores.ordenador_id', '=', 'o.id')
        ->where('aulas_ordenadores.aula_id',"=", $value) 
        ->orderBy('o.nombre','asc')
        ->get()
        ->toArray();

        if(empty($query)){
            return null;
        }

        return $query;
    }
}