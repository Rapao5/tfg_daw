<?php

namespace Database\Seeders;

use App\Models\AlumnosModel;
use App\Models\CursosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faker crea datos falsos reales
        $faker = Faker::create('es_ES'); // Configuramos Faker en español
      
        // Contamos cuántos cursos hay para generar 20 alumnos por cada uno
        $cantidadCursos = CursosModel::count();
        $totalAlumnos = $cantidadCursos > 0 ? $cantidadCursos * 20 : 1000;

        for ($i = 1; $i <= $totalAlumnos; $i++) {
            AlumnosModel::create([
                // Generamos un NRE aleatorio de 7 cifras único
                'nombre'    => $faker->firstName(),
                'apellidos' => $faker->lastName() . ' ' . $faker->lastName(),
                'nre'       => $faker->unique()->numberBetween(1000000, 9999999),
            ]);
        }
    }
}
