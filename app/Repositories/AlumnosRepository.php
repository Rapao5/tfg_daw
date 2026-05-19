<?php

namespace App\Repositories;

use App\Models\AlumnosModel as Alumnos;

class AlumnosRepository
{
    public static function getAlumnos(){
        return Alumnos::orderBy('apellidos', 'asc')->orderBy('nombre', 'asc')->get()->toArray();
    }
}
