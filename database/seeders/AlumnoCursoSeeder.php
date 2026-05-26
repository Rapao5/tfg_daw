<?php

namespace Database\Seeders;

use App\Models\CursosAlumnosModel;
use App\Models\CursosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlumnosModel;

class AlumnoCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtenemos todos los cursos y alumnos que ya existen en la BD
        $cursos = CursosModel::all();
        $alumnos = AlumnosModel::all();

        // 2. Llevamos un índice para saber qué alumno toca asignar
        $indiceAlumno = 0;

        // 3. Recorremos cada curso
        foreach ($cursos as $curso) {
            
            // 4. Por cada curso, hacemos un bucle de 20 para asignar alumnos
            for ($i = 0; $i < 20; $i++) {
                
                // Comprobamos que aún queden alumnos en la colección para evitar errores
                if (isset($alumnos[$indiceAlumno])) {
                    CursosAlumnosModel::create([
                        'curso_id'  => $curso->id,
                        'alumno_id' => $alumnos[$indiceAlumno]->id,
                    ]);
                    
                    // Pasamos al siguiente alumno
                    $indiceAlumno++;
                }
            }
        }
    }
}
