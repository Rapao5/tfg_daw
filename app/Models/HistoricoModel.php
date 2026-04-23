<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo HistoricoModel
 * 
 * Almacena el registro histórico de las asignaciones realizadas.
 * 
 * @property int $id
 * @property int $asignacion_id Referencia a la asignación de la que procede el registro.
 */
class HistoricoModel extends Model
{
    protected $table = "historic";

    protected $fillable = ['asignacion_id'];

    protected $hidden = ["update_at"];

    /**
     * Define la relación de pertenencia con una asignación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asignaciones(){
        return $this -> belongsTo(AsignacionesOrdenadoresModel::class);
    }
}
