<?php

namespace App\Repositories;

use App\Models\OrdenadoresModel as Ordenadores;

use App\Repositories\IncidenciasRepository as repoIncidencias;

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

    public static function getOrdenadorModel($id){
        return Ordenadores::find($id);
    }

    public static function comprobarEstado($ordenador_id){
        $ordenador = Ordenadores::find($ordenador_id);
        if($ordenador){ 
            if(!repoIncidencias::getIncidenciasByOrdenador($ordenador_id)){
                $ordenador->disponible = true;
                $ordenador->save();
            }   
        }
    }

    public static function marcarDeshabilitado($ordenador_id){
        $ordenador = Ordenadores::find($ordenador_id);
        if($ordenador){ 
            $ordenador->disponible = false;
            $ordenador->save();
        } else {
            dd('No se ha encontrado el ordenador con id: '.$ordenador_id);
        }
    }
}
