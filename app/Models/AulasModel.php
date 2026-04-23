<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo AulasModel
 * 
 * Representa los espacios físicos (clases) donde se ubican los ordenadores.
 * 
 * @property int $id
 * @property string $nombre Nombre descriptivo del aula (ej: Aula 22).
 */
class AulasModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "aulas";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["nombre"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];
}
