<?php

namespace Database\Seeders;

use App\Enum\IncidenciaStatus;
use App\Models\Incidencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Incidencia::create([
            'titulo' => 'Pantalla rota',
            'descripcion' => 'La pantalla del ordenador no funciona correctamente.',
            'fecha' => '2024-05-01',
            'ordenador_id' => 1,
            'status' => IncidenciaStatus::AVERIADO,
        ]);

        Incidencia::create([
            'titulo' => 'Teclado no responde',
            'descripcion' => 'El teclado del ordenador no responde al escribir.',
            'fecha' => '2024-05-02',
            'ordenador_id' => 2,
            'status' => IncidenciaStatus::ARREGLADO,
        ]);

        Incidencia::create([
            'titulo' => 'Problema de conexión a internet',
            'descripcion' => 'El ordenador no se conecta a la red Wi-Fi.',
            'fecha' => '2024-05-03',
            'ordenador_id' => 3,
            'status' => IncidenciaStatus::MANTENIMIENTO,
        ]);
    }
}
