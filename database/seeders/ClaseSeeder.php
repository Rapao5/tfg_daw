<?php

namespace Database\Seeders;

use App\Models\Clase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clase::create([
            'nombre' => 'Aula 22',
        ]);

        Clase::create([
            'nombre' => 'Aula 23',
        ]);

        Clase::create([
            'nombre' => 'Aula 24',
        ]);
    }
}
