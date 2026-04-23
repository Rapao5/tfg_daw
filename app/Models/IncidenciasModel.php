<?php

namespace App\Models;

use App\Enums\IncidenciaStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo IncidenciasModel
 * 
 * Representa una incidencia o avería registrada en un ordenador.
 * 
 * @property int $id
 * @property string $fecha Fecha y hora de la incidencia.
 * @property int $ordenador_id ID del ordenador afectado.
 * @property string $titulo Título breve del problema.
 * @property string $descripcion Detalle extendido de la incidencia.
 * @property bool $resuelto Indica si la incidencia ha sido cerrada.
 * @property \App\Enums\IncidenciaStatus $status Estado actual (AVERIADO, MANTENIMIENTO, etc).
 */
class IncidenciasModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "incidencias";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["fecha", "ordenador_id", "descripcion", "titulo", "resuelto"];

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
    function ordenadores(){
        return $this -> belongsTo(OrdenadoresModel::class);
    }

    /**
     * Los atributos que deben ser casts.
     * 
     * @return array<string, string>
     */
    protected function casts()
    {
        return[
            "status" => IncidenciaStatus::class
        ];
    }
}
