<?php

namespace Database\Seeders;

use App\Models\OrdenadoresModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrdenadoresModel::create([
            'nombre' => '1',
            'disponible' => false,
        ]);

        OrdenadoresModel::create([
            'nombre' => '2',
            'disponible' => true,
        ]);

        OrdenadoresModel::create([
            'nombre' => '3',
            'disponible' => false,
        ]);

        OrdenadoresModel::create([
            'nombre' => '4',
            'disponible' => true,
        ]);
        OrdenadoresModel::create([
            'nombre' => '5',
            'disponible' => true,
        ]);
        OrdenadoresModel::create([
            'nombre' => '6',
            'disponible' => true,
        ]);
        OrdenadoresModel::create([
            'nombre' => '7',
            'disponible' => true,
        ]);
        OrdenadoresModel::create([
            'nombre' => '8',
            'disponible' => true,
        ]);
    }
}
