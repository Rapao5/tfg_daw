<?php

namespace App\Repositories;

use App\Enums\IncidenciaStatus;
use App\Models\IncidenciasModel;
use Carbon\Carbon;

use App\Repositories\OrdenadoresRepository as repoOrdenadores;

class IncidenciasRepository
{
    /**
     * Crea una nueva incidencia y la persiste en la base de datos.
     *
     * @param array $value Datos de la incidencia (ordenador_id, titulo, descripcion, etc.).
     * @return bool Devuelve true o false en funcion de si se guarda o no
     */
    public static function createIncidencia($value){
        $fecha = $value['fecha'] ?? Carbon::now()->toDateString();
        $hora = $value['hora'] ?? Carbon::now()->toTimeString();
        
        $status = IncidenciaStatus::tryFrom($value['status'] ?? '') ?? IncidenciaStatus::PENDIENTE;

        $ordenador = repoOrdenadores::getOrdenadorModel($value['ordenador_id']);
        if(!$ordenador){
            return false;
        } else {
            if($value['disponibilidad']){
                $ordenador->disponible = false;
                $ordenador->save();
            }
        }

        $incidencia = new IncidenciasModel();
        $incidencia->ordenador_id = $value['ordenador_id'];
        $incidencia->titulo = $value['titulo'];
        $incidencia->descripcion = isset($value['descripcion']) ? $value['descripcion'] : '-';
        $incidencia->fecha = Carbon::createFromFormat('Y-m-d H:i:s',$fecha.' '.$hora);
        $incidencia->status = $status;
        $incidencia->resuelto = false;
        return $incidencia->save();
    }

    public static function getIncidencias($value){
        $query = IncidenciasModel::select(
            "incidencias.id as id",
            "o.nombre as ordenador_nombre",
            "incidencias.titulo as titulo",
            "incidencias.descripcion as descripcion",
            "incidencias.fecha as fecha",
            "incidencias.status as status",
            "incidencias.resuelto as resuelto"
        )
        ->join('ordenadores as o', 'incidencias.ordenador_id', '=', 'o.id');
        
        if (!empty($value['fecha_inicio'])) {
            $query->whereDate('incidencias.fecha', '>=', $value['fecha_inicio']);
        }

        if (!empty($value['fecha_fin'])) {
            $query->whereDate('incidencias.fecha', '<=', $value['fecha_fin']);
        }

        if(isset($value['ordenador_id']) && $value['ordenador_id']){
            $query->where('incidencias.ordenador_id', $value['ordenador_id']);
        }

        $status = IncidenciaStatus::tryFrom($value['status'] ?? null);
        
        if($status){
            $query->where('incidencias.status', $value['status']);
        }

        if(isset($value['resuelto']) && $value['resuelto']){
            $query->where('incidencias.resuelto', true);
        }

        return $query ->paginate(15);
    }

    public static function getIncidencia($incidencia_id){
        return IncidenciasModel::find($incidencia_id);
    }

    public static function getIncidenciasByOrdenador($ordenador_id){
        return IncidenciasModel::where('ordenador_id', $ordenador_id)
        ->get()
        ->toArray();
    }
}
