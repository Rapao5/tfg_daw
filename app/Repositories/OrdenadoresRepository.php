<?php

namespace App\Repositories;

use App\Models\OrdenadoresModel as Ordenadores;

class OrdenadoresRepository
{
    public static function getOrdenador($id){
        return Ordenadores::whereId($id)
        ->get()
        ->toArray();
    }

    public static function getOrdenadores(){
        return Ordenadores::all()
        ->toArray();
    }
}
