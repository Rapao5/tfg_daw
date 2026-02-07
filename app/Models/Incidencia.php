<?php

namespace App\Models;

use App\Enum\IncidenciaStatus;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "incidencia";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["fecha", "ordenador_id", "descripcion", "titulo"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];

    /**
     * Define la relación de pertenencia con el modelo Ordenador.
     * 
     * @return belongsTo
     */
    function ordenador(){
        return $this -> belongsTo(Ordenador::class);
    }

    /**
     * Los atributos que deben ser casts.
     * 
     * @return array<string, string>
     */
    protected function casts()
    {
        return[
            "status" => IncidenciaStatus::values()
        ];
    }
}
