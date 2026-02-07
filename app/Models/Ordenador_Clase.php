<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordenador_Clase extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "ordenador_clase";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["ordenador_id", "clase_id"];

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
     * Define la relación de pertenencia con el modelo Clase.
     * 
     * @return belongsTo
     */
    function clase(){
        return $this -> belongsTo(Clase::class);
    }
}
