<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo CursosAlumnosModel
 * 
 * Gestiona la relación entre alumnos y los cursos en los que están inscritos.
 * 
 * @property int $alumno_id ID del alumno.
 * @property int $curso_id ID del curso.
 */
class CursosAlumnosModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "cursos_alumnos";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["alumno_id", "curso_id"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["created_at","updated_at"];

    /**
     * Define la relación de pertenencia con el modelo Alumno.
     * 
     * @return BelongsTo
     */
    function alumnos(){
        return $this -> BelongsTo(AlumnosModel::class);
    }

    /**
     * Define la relación de pertenencia con el modelo Curso.
     * 
     * @return BelongsTo
     */
    function cursos(){
        return $this -> belongsTo(CursosModel::class);
    } 

}
