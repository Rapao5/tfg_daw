<?php

namespace Database\Seeders;

use App\Models\Ordenador_Clase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenadorClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ordenador_Clase::create([
            'ordenador_id' => 1,
            'clase_id' => 1
        ]);

        Ordenador_Clase::create([
            'ordenador_id' => 2,
            'clase_id' => 1
        ]);
        Ordenador_Clase::create([
            'ordenador_id' => 3,
            'clase_id' => 1
        ]);
        Ordenador_Clase::create([
            'ordenador_id' => 4,
            'clase_id' => 1
        ]);

        Ordenador_Clase::create([
            'ordenador_id' => 5,
            'clase_id' => 2
        ]);

        Ordenador_Clase::create([
            'ordenador_id' => 6,
            'clase_id' => 2
        ]);
        Ordenador_Clase::create([
            'ordenador_id' => 7,
            'clase_id' => 3
        ]);

        Ordenador_Clase::create([
            'ordenador_id' => 8,
            'clase_id' => 3
        ]);
    }
}
