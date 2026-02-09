<?php

namespace Database\Seeders;

use App\Models\Ordenador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ordenador::create([
            'nombre' => '1',
            'estado' => true,
        ]);

        Ordenador::create([
            'nombre' => '2',
            'estado' => false,
        ]);

        Ordenador::create([
            'nombre' => '3',
            'estado' => true,
        ]);

        Ordenador::create([
            'nombre' => '4',
            'estado' => false,
        ]);
        Ordenador::create([
            'nombre' => '5',
            'estado' => false,
        ]);
        Ordenador::create([
            'nombre' => '6',
            'estado' => false,
        ]);
        Ordenador::create([
            'nombre' => '7',
            'estado' => false,
        ]);
        Ordenador::create([
            'nombre' => '8',
            'estado' => false,
        ]);
    }
}
