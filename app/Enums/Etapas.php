<?php

namespace App\Enums;

/**
 * Enum Etapas
 * 
 * Representa las diferentes etapas educativas disponibles.
 */
enum Etapas: String
{
    case ESO = "ESO";
    case BACHILLERATO = "BACHILLERATO";
    case FP = "FP";

    /**
     * Obtiene un array con todos los valores de las etapas educativas.
     * 
     * @return array<string> Un array de strings con los valores de cada caso del enum.
     */
    public static function values(): array {
        return array_column(self::cases(), "value");
    }
    
}