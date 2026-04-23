<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Etapas;

/**
 * Modelo CursosModel
 * 
 * Representa un curso académico (ej: 1º DAW).
 * 
 * @property int $id
 * @property string $nivel Nivel del curso (1, 2, etc).
 * @property string $letra Identificador del grupo (A, B, DAW, ASIR).
 * @property \App\Enums\Etapas $status Etapa educativa asociada.
 */
class CursosModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "cursos";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["nivel", "letra"];
    
    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];

    /**
     * Los atributos que deben ser casts.
     * 
     * @return array<string, string>
     */
    protected function casts()
    {
        return[
            "status" => Etapas::class
        ];
    }
}
