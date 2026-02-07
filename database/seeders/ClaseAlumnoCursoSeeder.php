<?php

namespace Database\Seeders;

use App\Models\Clase;
use App\Models\Clase_Alumno_Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaseAlumnoCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clase_Alumno_Curso::create([
            'ordenador_clase_id' => 1,
            'alumno_curso_id' => 1
        ]);

        Clase_Alumno_Curso::create([
            'ordenador_clase_id' => 2,
            'alumno_curso_id' => 2
        ]);

        Clase_Alumno_Curso::create([
            'ordenador_clase_id' => 3,
            'alumno_curso_id' => 3
        ]);

        Clase_Alumno_Curso::create([
            'ordenador_clase_id' => 4,
            'alumno_curso_id' => 4
        ]);
    }
}
