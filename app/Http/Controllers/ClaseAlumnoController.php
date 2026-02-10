<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearClaseRequest;
use App\Http\Requests\EditarClaseRequest;
use App\Http\Requests\FilterClaseAlumnoRequest;
use App\Http\Requests\MiniDeleteRequest;
use App\Models\Clase;
use App\Models\Curso;
use App\Services\ClaseAlumnoService;

class ClaseAlumnoController extends Controller
{
    protected $claseAlumnoService;

    public function __construct(ClaseAlumnoService $claseAlumnoService) {
        $this->claseAlumnoService = $claseAlumnoService;
    }

    public function filtrar(FilterClaseAlumnoRequest $validator){
        $value = $validator->all();

        $claseAlumno = $this -> claseAlumnoService -> filtrar($value);
        $ordenadores = $this -> claseAlumnoService -> mostrarOrdenador($value['clase_id']);
        $clases = Clase::get();
        $cursos = Curso::get();

        return view('clase',compact('claseAlumno', "clases", "cursos", 'ordenadores', 'value'));
    }

    public function vista(){
        $clases = Clase::get();
        $cursos = Curso::get();

        return view('clase', compact("clases", "cursos"));
    }

    public function vistaCrear(){
        $clases = Clase::get();
        $cursos = Curso::get();

        return view('crear', compact( 'clases', 'cursos' ));
    }

    public function mostrarCrear(FilterClaseAlumnoRequest $request){
        $value = $request ->all();

        $clases = Clase::get();
        $cursos = Curso::get();

        $ordenadores = $this -> claseAlumnoService -> mostrarOrdenador($value['clase_id']);
        $alumnos = $this -> claseAlumnoService -> mostrarAlumno($value['curso_id']);

        return view('crear', compact('ordenadores', 'alumnos', 'clases', 'cursos', 'value'));
    }

    public function crear(CrearClaseRequest $request){
        $value = $request -> all();

        $this -> claseAlumnoService -> crearClase($value);

        return view('clase');
    }

    public function miniBorrar(MiniDeleteRequest $request){
        $value = $request -> all();
        $this -> claseAlumnoService -> miniBorrarClaseAlumnoCurso($value['clase_alumno_curso_id']);

        $ids =[
            "clase_id" =>$value['clase_id'],
            "curso_id"=>$value['curso_id']
        ];
        $claseAlumno = $this -> claseAlumnoService -> filtrar($ids);
        $ordenadores = $this -> claseAlumnoService -> mostrarOrdenador($value['clase_id']);
        $clases = Clase::get();
        $cursos = Curso::get();
        
        return view('clase',compact('claseAlumno', "clases", "cursos", 'ordenadores', 'ids'));
    }

    /* Esta funcion esta en cuarentena de momento
    public function editar(EditarClaseRequest $request){
        $value = $request ->all();

        $this -> claseAlumnoService -> editarClase($value);

        return view('clase');
    }*/
}