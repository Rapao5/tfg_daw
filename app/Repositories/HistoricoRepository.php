<?php

namespace App\Repositories;

use App\Models\HistoricoModel as Historico;

class HistoricoRepository
{
    /**
     * Crea múltiples entradas en el histórico a partir de una lista de asignaciones.
     *
     * @param array $value Lista de arrays, donde cada uno contiene 'asignacion_id'.
     * @return void
     */
    public static function createHistorico($value){
        foreach($value as $valor){
            $historico = new Historico();
            $historico->asignacion_id = $valor['asignacion_id'];
            $historico->save();
        }
    }
}
