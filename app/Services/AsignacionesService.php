<?php

namespace App\Services;

use App\Repositories\CursosAlumnosRepository;
use App\Repositories\AsignacionesOrdenadoresRepository;
use App\Repositories\AulasOrdenadoresRepository;
use App\Repositories\HistoricoRepository;

/**
 * Clase AsignacionesService
 * 
 * Capa de servicios que orquesta la lógica de negocio entre los controladores y los repositorios
 */
class AsignacionesService
{
    /**
     * Filtra y obtiene las asignaciones de ordenadores activas.
     *
     * @param array $value Contiene 'curso_id' y 'aula_id'.
     * @return \Illuminate\Support\Collection|null
     */
    public function filtrar($value){
        $asignaciones = AsignacionesOrdenadoresRepository::getAsignaciones($value['curso_id'], $value['aula_id']);
        
        return $asignaciones;
    }

    /**
     * Obtiene el listado de ordenadores asociados a un aula.
     *
     * @param int $id ID del aula.
     * @return array|null
     */
    public function mostrarOrdenador($id){
        $ordenadores = AulasOrdenadoresRepository::getOrdenadores($id);

        return $ordenadores;
    }

    /**
     * Obtiene el listado de alumnos asociados a un curso.
     *
     * @param int $id ID del curso.
     * @return array|null
     */
    public function mostrarAlumno($id){
        $alumno = CursosAlumnosRepository::getAlumnos($id);
        return $alumno;
    }
    
/* Funcion en cuarentena de momento.

    public function mostrarEditar($value){
        $claseAlumno = new Clase_Alumno_Curso();
        $query = $claseAlumno ->from("clase_alumno_curso as cac")
        ->leftJoin('alumno_curso as ac', 'cac.alumno_curso_id', '=', 'ac.id') 
        ->leftJoin('alumno as a', 'ac.alumno_id', '=', 'a.id')
        ->leftJoin('ordenador_clase as oc', 'cac.ordenador_clase_id', '=', 'oc.id')
        ->leftJoin('ordenador as o',"oc.ordenador_id","=","o.id")
        ->where('ac.curso_id',"=", $value["curso_id"]) 
        ->where('oc.clase_id',"=", $value["clase_id"]) 
        ->select('a.nombre as nombre_alumno', "a.apellido as apellido_alumno", "o.id", "cac.id")
        ->orderBy("o.id","asc")
        ->get();

        if(empty($query)){
            return null;
        }
        return $query;
    }     

    public function editarClase($value){
        foreach($value as $valor){
            $this -> existAlumnoCurso($valor['alumno_curso_id']);
            $this -> existClaseAlumnoCurso($valor['clase_alumno_curso_id']);

            $editar = Clase_Alumno_Curso::find($valor['clase_alumno_curso_id']);
            $editar -> alumno_curso_id = $valor['alumno_curso_id'];
            $editar -> save();
        }
    }
*/
    
    /**
     * Crea registros en el historial de asignaciones.
     *
     * @param array $value Lista de datos de asignación para persistir.
     * @return void
     */
    public function historico($value){
        HistoricoRepository::createHistorico($value);
    }

    /**
     * Ejecuta el borrado lógico de una asignación.
     *
     * @param int $asignacion_id ID de la asignación a desactivar.
     * @return void
     */
    public function miniBorrarAsignacionOrdenador($asignacion_id){
        AsignacionesOrdenadoresRepository::miniBorrar($asignacion_id);
    }

    /**
     * Crea o reactiva una asignación de ordenador para un alumno.
     *
     * @param array $value Contiene 'alumno_id' y 'ordenador_id'.
     * @return void
     */
    public function miniCrearAsignacionOrdenador($value){
        AsignacionesOrdenadoresRepository::miniCrear($value);
    }

    /**
     * Obtiene los alumnos de un curso que no tienen asignado un equipo en un aula específica.
     *
     * @param int $curso_id
     * @param int $aula_id
     * @return array
     */
    public function alumnosSinOrdenador($curso_id, $aula_id){
        return AsignacionesOrdenadoresRepository::getAlumnosSinOrdenador($curso_id, $aula_id);
    }
}
