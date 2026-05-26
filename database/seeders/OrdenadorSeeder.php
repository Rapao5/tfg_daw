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
        for ($i = 1; $i <= 164; $i++) {
            OrdenadoresModel::create([
                'nombre' => (string) $i,
                'disponible' => true,
            ]);
        }
    }
}
