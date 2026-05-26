<?php

namespace Database\Seeders;

use App\Models\AulasModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AulasModel::create([
            'nombre' => 'A0.1',
        ]);

        AulasModel::create([
            'nombre' => 'A0.11',
        ]);

        AulasModel::create([
            'nombre' => 'A0.15',
        ]);

        AulasModel::create([
            'nombre' => 'CHR0.1',
        ]);

        AulasModel::create([
            'nombre' => 'CHR0.2',
        ]);

        AulasModel::create([
            'nombre' => 'CHR1.1',
        ]);

        AulasModel::create([
            'nombre' => 'CHR1.2',
        ]);
    }
}
