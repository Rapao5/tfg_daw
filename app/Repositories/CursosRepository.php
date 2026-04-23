<?php

namespace App\Repositories;

use App\Models\CursosModel as Cursos;

class CursosRepository
{
    /**
     * Obtiene todos los cursos registrados en el sistema.
     *
     * @return array Lista de todos los cursos.
     */
    public static function getCursos(){
        return Cursos::all()
        ->toArray();
    }
}
