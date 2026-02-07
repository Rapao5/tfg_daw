<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumno::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan.perez@example.com',
        ]);

        Alumno::create([
            'nombre' => 'María',
            'apellido' => 'Gómez',
            'email' => 'maria.gomez@example.com',
        ]);

        Alumno::create([
            'nombre' => 'Carlos',
            'apellido' => 'López',
            'email' => 'carlos.lopez@example.com',
        ]);

        Alumno::create([
            'nombre' => 'Ana',
            'apellido' => 'Martínez',
            'email' => 'ana.martinez@example.com',
        ]);
    }
}
