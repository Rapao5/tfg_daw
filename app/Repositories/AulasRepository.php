<?php

namespace App\Repositories;

use App\Models\AulasModel as Aulas;

class AulasRepository
{
    /**
     * Obtiene todas las aulas registradas en el sistema.
     *
     * @return array Lista de todas las aulas.
     */
    public static function getAulas(){
        return Aulas::all()
        ->toArray();
    }
}
