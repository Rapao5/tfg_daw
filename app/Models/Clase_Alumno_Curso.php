<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase_Alumno_Curso extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "clase_alumno_curso";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["ordenador_clase_id", "alumno_curso_id"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];

    /**
     * Define la relación de pertenencia con el modelo Ordenador_Clase.
     * 
     * @return belongsTo
     */
    function ordenador_clase(){
        return $this -> belongsTo(Ordenador_Clase::class);
    }

    /**
     * Define la relación de pertenencia con el modelo Alumno_Curso.
     * 
     * @return belongsTo
     */
    function alumno_curso(){
        return $this -> belongsTo(Alumno_Curso::class);
    }
}
