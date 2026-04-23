<?php

namespace App\Repositories;

use App\Models\CursosAlumnosModel as CursosAlumnos;

class CursosAlumnosRepository
{
    /**
     * Obtiene los alumnos pertenecientes a un curso específico.
     *
     * @param int|string $value ID del curso.
     * @return array|null Lista de alumnos o null si el curso está vacío.
     */
    public static function getAlumnos($value){
        $query = CursosAlumnos::select(
            "a.nombre as nombre",
            "a.apellido as apellidos",
            "a.id as id"
        )
        ->join('alumnos as a', 'cursos_alumnos.alumno_id', '=', 'a.id')
        ->where('curso_id', $value)
        ->get()
        ->toArray();

        if(empty($query)){
            return null;
        }

        return $query;
    }
}
