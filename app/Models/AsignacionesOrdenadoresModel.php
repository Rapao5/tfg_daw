<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo AsignacionesOrdenadoresModel
 * 
 * Gestiona la asignación específica de un ordenador a un alumno.
 * 
 * @property int $id
 * @property int $alumno_id ID del alumno asignado.
 * @property int $ordenador_id ID del ordenador asignado.
 * @property bool $is_enabled Estado de la asignación (activo/inactivo).
 */
class AsignacionesOrdenadoresModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "asignaciones_ordenadores";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["alumno_id", "ordenador_id", "is_enabled"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];

    /**
     * Define la relación de pertenencia con el modelo Ordenador_Clase.
     * 
     * @return BelongsTo
     */
    function ordenador_clase(){
        return $this -> belongsTo(OrdenadoresModel::class);
    }

    /**
     * Define la relación de pertenencia con el modelo Alumno_Curso.
     * 
     * @return belongsTo
     */
    function alumno_curso(){
        return $this -> belongsTo(AlumnosModel::class);
    }
}
