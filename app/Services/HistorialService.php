<?php

namespace App\Services;

use App\Repositories\HistoricoRepository as repoHistorial;

class HistorialService
{
    /**
     * Devuelve un un array formateado para meterlo en una tabla
     * 
     * @param array $data Datos del filtro 
     * @return Object
     */
    public function getHistorico($data){
        return repoHistorial::getHistorico($data);
    }

    /**
     * Crea registros en el historial de asignaciones.
     *
     * @param array $value Lista de datos de asignación para persistir.
     * @return bool
     */
    public function historico($value){
        return repoHistorial::createHistorico($value);
    }

}