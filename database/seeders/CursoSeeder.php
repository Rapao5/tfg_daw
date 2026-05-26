<?php

namespace Database\Seeders;

use App\Enums\Etapas;
use App\Models\CursosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = base_path('Documentación/Estudios_Grupos_Final.xlsx');
        
        if (!file_exists($filePath)) {
            $this->command->error("Archivo no encontrado en: $filePath");
            return;
        }

        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        array_shift($rows); 

        foreach ($rows as $row) {
            $descripcionRaw = $row[0];
            $grupoRaw = $row[1];
            
            $etapa = 'OTRA';
            $nivel = '';
            $letra = '';
        
            if (str_contains($descripcionRaw, 'Secundaria')) {
                $etapa = 'ESO';
                $nivel = mb_substr($grupoRaw, 1, 1) . 'º';
                
                $letraBase = mb_substr($grupoRaw, 2);
                
                // IMPORTANTE: Usamos el palito | para separar la letra del programa
                $letra = $letraBase . "\n";
                
            }
            
            elseif (str_contains($descripcionRaw, 'Bachillerato')) {
                $etapa = 'BACHILLERATO';
                $nivel = mb_substr($grupoRaw, 1, 1) . 'º';
                $letra = mb_substr($grupoRaw, 2);
            } 
            else {
                // --- LÓGICA PARA FP ---
                $etapa = 'FP';
                $nivel = mb_substr($grupoRaw, -1) . 'º';
                
                // Guardamos la modalidad (todo menos el último número, ej: DAW, SMR, ASIR)
                $letra = mb_substr($grupoRaw, 0, -1); 
            }
        
            CursosModel::create([
                'nivel' => $nivel,
                'letra' => $letra,
                'etapas' => $etapa,
            ]);
        }
        
        $this->command->info('Cursos importados correctamente.');
    }
}
