<?php

namespace App\Enums;

/**
 * Enum IncidenciaStatus
 * 
 * Define los posibles estados de una incidencia.
 */
enum IncidenciaStatus:string
{
    case AVERIADO = "AVERIADO";
    case MANTENIMIENTO = "MANTENIMIENTO";
    case RESUELTO = "RESUELTO";
    case PENDIENTE = "PENDIENTE";
    case SIN_SOLUCION = "SIN_SOLUCION";

    /**
     * Obtiene un array con todos los valores de los estados de incidencia.
     * 
     * @return array<string> Un array de strings con los valores de cada caso del enum.
     */
    public static function values(){
        return array_column(self::cases(),"value");
    }
}
