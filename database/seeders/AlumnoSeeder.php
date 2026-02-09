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
            "nre" => "168451"
        ]);

        Alumno::create([
            'nombre' => 'María',
            'apellido' => 'Gómez',
            "nre" => "894512"
        ]);

        Alumno::create([
            'nombre' => 'Carlos',
            'apellido' => 'López',
            "nre" => "6845165"
        ]);

        Alumno::create([
            'nombre' => 'Ana',
            'apellido' => 'Martínez',
            "nre" => "165321"
        ]);
        Alumno::create([
            'nombre' => 'Dani',
            'apellido' => 'Zamora',
            "nre" => "164234"
        ]);
        Alumno::create([
            'nombre' => 'Estefania',
            'apellido' => 'Martínez',
            "nre" => "123431"
        ]);
    }
}
