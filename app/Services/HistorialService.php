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
        return repoHistorial::getHistorico($data);
    }
}