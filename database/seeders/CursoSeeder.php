<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::create([
            'nombre' => '1º DAW',
        ]);

        Curso::create([
            'nombre' => '2º DAW',
        ]);

        Curso::create([
            'nombre' => '1º ASIR',
        ]);
    }
}
