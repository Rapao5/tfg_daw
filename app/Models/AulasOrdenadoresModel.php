<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo AulasOrdenadoresModel
 * 
 * Representa la relación pivot entre Aulas y Ordenadores.
 * 
 * @property int $ordenador_id ID del ordenador.
 * @property int $aula_id ID del aula.
 */
class AulasOrdenadoresModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "aulas_ordenadores";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["ordenador_id", "aula_id"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];

    /**
     * Define la relación de pertenencia con el modelo Ordenador.
     * 
     * @return BelongsTo
     */
    function ordenador(){
        return $this -> belongsTo(OrdenadoresModel::class);
    }

    /**
     * Define la relación de pertenencia con el modelo Clase.
     * 
     * @return BelongsTo
     */
    function clase(){
        return $this -> belongsTo(AulasModel::class);
    }
}
