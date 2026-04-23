<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo AlumnosModel
 * 
 * Representa a los estudiantes registrados en el sistema.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $nre Número Regional de Estudiante.
 */
class AlumnosModel extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "alumnos";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["nombre","apellido","nre"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at"];
}
