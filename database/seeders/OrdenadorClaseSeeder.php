<?php

namespace Database\Seeders;

use App\Models\AulasOrdenadoresModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenadorClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 28; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 1,
            ]);
        }

        for ($i = 29; $i <= 56; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 2,
            ]);
        }

        for ($i = 57; $i <= 84; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 3,
            ]);
        }

        for ($i = 85; $i <= 104; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 4,
            ]);
        }

        for ($i = 105; $i <= 124; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 5,
            ]);
        }

        for ($i = 125; $i <= 144; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 6,
            ]);
        }

        for ($i = 145; $i <= 164; $i++) {
            AulasOrdenadoresModel::create([
                'ordenador_id' => $i,
                'aula_id' => 7,
            ]);
        }
    }
}
