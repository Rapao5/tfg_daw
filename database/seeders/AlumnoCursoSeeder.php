<?php

namespace Database\Seeders;

use App\Models\Alumno_Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumno_Curso::create([
            'alumno_id' => 1,
            'curso_id' => 1,
        ]);

        Alumno_Curso::create([
            'alumno_id' => 2,
            'curso_id' => 1,
        ]);

        Alumno_Curso::create([
            'alumno_id' => 3,
            'curso_id' => 2,
        ]);
        Alumno_Curso::create([
            'alumno_id' => 4,
            'curso_id' => 2,
        ]);
    }
}
