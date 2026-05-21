<?php

namespace App\Repositories;

use App\Models\HistoricoModel as Historico;

use App\Http\Requests\CreateHistoricoRequest;

use App\Repositories\AsignacionesOrdenadoresRepository as repoAsignaciones;

class HistoricoRepository
{
    /**
     * Crea múltiples entradas en el histórico a partir de una lista de asignaciones.
     *
     * @param array $value Lista de arrays, donde cada uno contiene 'asignacion_id'.
     * @return bool
     */
    public static function createHistorico($value){
        $asignaciones = repoAsignaciones::getAsignaciones($value['curso_id'], $value['aula_id']);

        if(empty($asignaciones)){
            return false;
        }

        foreach($asignaciones as $valor){
            $historico = new Historico();
            $historico->asignacion_id = $valor['asignacion_id'];
            $historico->save();
        }
        return true;
    }

    /**
     * Devuelve una lista de historial formateada para meterlo en una tabla
     * 
     * @param array $data Valores enviados por el filtro
     * @return array 
     */
    public static function getHistorico($data)
    {
        $query = Historico::select(
            "historico.id as id",
            "o.nombre as ordenador_nombre",
            "a.nombre as alumno_nombre",
            "a.apellidos as alumno_apellidos",
            "c.nivel as curso_nivel",
            "c.letra as curso_letra",
            "au.nombre as aula_nombre",
            "historico.created_at as fecha"
        )
        ->from('historico')
        ->join('asignaciones_ordenadores as ao', 'historico.asignacion_id', '=', 'ao.id')
        ->join('ordenadores as o', 'ao.ordenador_id', '=', 'o.id')
        ->join('alumnos as a', 'ao.alumno_id', '=', 'a.id')
        ->join('cursos_alumnos as ca', 'a.id', '=', 'ca.alumno_id')
        ->join('cursos as c', 'ca.curso_id', '=', 'c.id')
        ->join('aulas_ordenadores as auo', 'ao.ordenador_id', '=', 'auo.ordenador_id')
        ->join('aulas as au', 'auo.aula_id', '=', 'au.id')
        ->whereDate('historico.created_at', ">=", $data['fecha_inicio'])
        ->whereDate('historico.created_at', "<=", $data['fecha_fin'])
        ->whereTime('historico.created_at', ">=", $data['hora_inicio'])
        ->whereTime('historico.created_at', "<=", $data['hora_fin']);
        
        if(isset($data['cursos_id']) && $data['cursos_id']){
            $query->where('ca.curso_id', $data['cursos_id']);
        }

        if(isset($data['aula_id']) && $data['aula_id']){
            $query->where('au.id', $data['aula_id']);
        }
        
        /* ESTO DE AQUI A LO MEJOR SE CAMBIA POR NOMBRES EN VEZ DE IDS SI ESTAS LEYENDO ESTO, 
        SEGURAMENE NO LO HAYAOS CAMBIADO AL FINAL Y SE ME HA OLVIDADO QUITARLO */

        if(isset($data['alumno_id']) && $data['alumno_id']){
            $query->where('a.id', $data['alumno_id']);
        }

        if(isset($data['ordenador_id']) && $data['ordenador_id']){
            $query->where('o.id', $data['ordenador_id']);
        }

        return $query->get()->toArray();
    }
}
