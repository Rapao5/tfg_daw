<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo ProfesoresModel
 * 
 * Modelo para la autenticación y gestión de profesores.
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $password
 */
class ProfesoresModel extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = "profesores";

    /**
     * Los atributos que son asignables en masa.
     * 
     * @var list<string>
     */
    protected $fillable = ["nombre", "apellidos", "email", "password", "rol"];

    /**
     * Los atributos que deben ocultarse para la serialización.
     * 
     * @var list<string>
     */
    protected $hidden = ["updated_at","created_at","password"];

    /**
     * Los atributos que deben ser casts.
     * 
     * @return array<string, string>
     */
    protected function casts():array{
        return [
            "password" => "hashed"
        ];
    }
}
