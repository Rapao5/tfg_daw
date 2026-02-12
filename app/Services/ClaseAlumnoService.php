<?php

namespace App\Services;

use App\Exceptions\NotFoundAlumnoCursoException;
use App\Exceptions\NotFoundClaseAlumnoCursoException;
use App\Exceptions\NotFoundClaseException;
use App\Exceptions\NotFoundCursoException;
use App\Exceptions\NotFoundOrdenadorClaseException;
use App\Models\Alumno_Curso;
use App\Models\Clase;
use App\Models\Clase_Alumno_Curso;
use App\Models\Curso;
use App\Models\Ordenador_Clase;
use Illuminate\Http\Response;

class ClaseAlumnoService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function filtrar($value){
        $this -> existClase($value['clase_id']);
        $this -> existCurso($value["curso_id"]);
        $claseAlumno = new Clase_Alumno_Curso();
        $query = $claseAlumno ->from("clase_alumno_curso as cac")
        ->leftJoin('alumno_curso as ac', 'cac.alumno_curso_id', '=', 'ac.id') 
        ->leftJoin('alumno as a', 'ac.alumno_id', '=', 'a.id')
        ->leftJoin('ordenador_clase as oc', 'cac.ordenador_clase_id', '=', 'oc.id')
        ->leftJoin('ordenador as o',"oc.ordenador_id","=","o.id")
        ->where('ac.curso_id',"=", $value["curso_id"]) 
        ->where('oc.clase_id',"=", $value["clase_id"]) 
        ->select('a.nombre as nombre_alumno', "a.apellido as apellido_alumno", "o.nombre as nombre_ordenador", "o.id", "cac.id as cac_id")
        ->orderBy("o.id","asc") 
        ->get();

        return $query;
    }

    public function mostrarOrdenador($id){
        $this -> existClase($id);
        $ordenador = new Ordenador_Clase();
        $query = $ordenador -> from('ordenador_clase as oc')
        ->leftJoin("ordenador as o", "oc.ordenador_id", "=", "o.id")
        ->where("oc.clase_id", $id)
        ->select("o.id as ordenador_id", "o.nombre as nombre_ordenador", "oc.id")
        ->orderBy("o.id", "asc")
        ->get();

        return $query;
    }

    public function mostrarAlumno($id){
        $this -> existCurso($id);
        $alumno = new Alumno_Curso();
        $query = $alumno -> from("alumno_curso as ac")
        ->leftJoin("alumno as a", "ac.alumno_id", "=", "a.id")
        ->where("ac.curso_id", $id)
        ->select("a.nombre as nombre_alumno", "a.apellido as apellido_alumno", "ac.id")
        ->orderBy("a.nombre", "asc")
        ->get();

        return $query;
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
    }*/

    public function crearClase($value){
        $this -> deleteClaseAlumnoCurso($value['clase_id'], $value['curso_id']);
        foreach ($value as $valor) {
            $this -> existOrdenadorClase($valor['ordenador_clase_id']);
            $this -> existAlumnoCurso($valor['alumno_curso_id']);

            $clase = new Clase_Alumno_Curso();
            $clase -> fill($valor);
            $clase -> save();
        }
    }

    private function deleteClaseAlumnoCurso($clase_id, $curso_id){
        $claseAlumnoCurso = new Clase_Alumno_Curso();

        $query = $claseAlumnoCurso ->from("clase_alumno_curso as cac")
        ->leftJoin('alumno_curso as ac', 'cac.alumno_curso_id', '=', 'ac.id') 
        ->leftJoin('ordenador_clase as oc', 'cac.ordenador_clase_id', '=', 'oc.id')
        ->where('ac.curso_id',"=", $curso_id) 
        ->where('oc.clase_id',"=", $clase_id) 
        ->pluck("cac.id");
        
        $claseAlumnoCurso->whereIn('id', $query)->delete();
    }

    public function miniBorrarClaseAlumnoCurso($id){
        $this -> existClaseAlumnoCurso($id);
        Clase_Alumno_Curso::findOrFail($id)->delete();
    }

    public function miniCrear($value){
        $this -> existAlumnoCurso($value['alumno_curso_id']);
        $this -> existOrdenadorClase($value["ordenador_clase_id"]);
        $this -> existAsignacion($value["ordenador_clase_id"],$value['alumno_curso_id']);

        $asignacion = new Clase_Alumno_Curso();
        $asignacion -> fill($value);
        $asignacion -> save();
    }

    public function alumnosSinOrdenador($id){
        return Alumno_Curso::where('curso_id', $id)
        ->whereDoesntHave('ordenadores')
        ->with('alumno')
        ->get();
    }

    private function existClase($id){
        $clase = Clase::find($id);

        if(empty($clase)) throw new NotFoundClaseException("Clase no encontrada", Response::HTTP_NOT_FOUND);
    }

    private function existCurso($id){
        $curso = Curso::find($id);

        if(empty($curso)) throw new NotFoundCursoException("Curso no encontrado", Response::HTTP_NOT_FOUND);
    }

    private function existOrdenadorClase($id){
        $ordenadorClase = Ordenador_Clase::find($id);

        if(empty($ordenadorClase)) throw new NotFoundOrdenadorClaseException("Ordenador no encontrado", Response::HTTP_NOT_FOUND);
    }

    private function existAlumnoCurso($id){
        $alumnoCurso = Alumno_Curso::find($id);

        if(empty($alumnoCurso)) throw new NotFoundAlumnoCursoException("Alumno no encontrado", Response::HTTP_NOT_FOUND);
    }

    private function existClaseAlumnoCurso($id){
        $claseAlumnoCurso = Clase_Alumno_Curso::find($id);

        if(empty($claseAlumnoCurso)) throw new NotFoundClaseAlumnoCursoException("ClaseAlumnoCurso no encontrado", Response::HTTP_NOT_FOUND);
    }

    private function existAsignacion($clase_id, $curso_id){
        $asignacion = Clase_Alumno_Curso::where('alumno_curso_id',$curso_id)
        ->where('ordenador_clase_id',$clase_id) 
        ->get();

        if(!empty($asignacion)) return redirect()->back();
    }
}
