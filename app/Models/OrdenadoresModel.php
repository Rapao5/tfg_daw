<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo OrdenadoresModel
 * 
 * Representa el hardware físico disponible en el centro.
 * 
 * @property int $id
 * @property string $nombre Etiqueta o número del ordenador.
 * @property string $estado Estado físico o lógico del equipo.
 */
class OrdenadoresModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "ordenadores";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["nombre", "disponible"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];
}
