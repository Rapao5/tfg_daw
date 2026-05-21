<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterAsignacionesOrdenadoresRequest;
use App\Http\Requests\MiniCrearRequest;
use App\Http\Requests\MiniDeleteRequest;
use App\Repositories\CursosRepository as repoCursos;
use App\Repositories\AulasRepository as repoAulas;
use App\Services\AsignacionesService  as servAsignaciones;

/**
 * Clase AsignacionesOrdenadorController
 * 
 * Gestiona la lógica de visualización y asignación de ordenadores a alumnos
 * dentro de las aulas y cursos específicos.
 */
class AsignacionesOrdenadorController extends Controller
{
    /**
     * Servicio para gestionar la lógica de negocio de asignaciones.
     * 
     * @var servAsignaciones
     */
    protected $asignacionesService;

    /**
     * Constructor del controlador.
     * 
     * @param servAsignaciones $asignacionesService Inyección del servicio de asignaciones.
     */
    public function __construct(servAsignaciones $asignacionesService) {
        $this->asignacionesService = $asignacionesService;
    }

    /**
     * Filtra y muestra la vista de una clase con sus asignaciones, ordenadores y alumnos.
     *
     * @param FilterAsignacionesOrdenadoresRequest $request Contiene 'aula_id' y 'curso_id'.
     * @return \Illuminate\View\View Vista 'clase' con los datos filtrados.
     */
    public function filtrar(FilterAsignacionesOrdenadoresRequest $request){
        $value = $request->validated();

        $asignaciones = $this->asignacionesService->filtrar($value);
        $ordenadores = $this->asignacionesService->mostrarOrdenador($value['aula_id']);
        $alumnos = $this->asignacionesService->alumnosSinOrdenador($value['curso_id'], $value['aula_id']);
        $aulas = repoAulas::getAulas();
        $cursos = repoCursos::getCursos();

        return view('clase',compact('asignaciones', "aulas", "cursos", 'ordenadores', 'value', 'alumnos'));
    }

    /**
     * Muestra la vista inicial de gestión de clases sin filtros aplicados.
     *
     * @return \Illuminate\View\View Vista 'clase' con listados de aulas y cursos.
     */
    public function vista(){
        $aulas = repoAulas::getAulas();
        $cursos = repoCursos::getCursos();
        return view('clase', compact("aulas", "cursos"));
    }

    /**
     * Realiza un borrado lógico de una asignación de ordenador.
     *
     * @param MiniDeleteRequest $request Contiene el 'asignacion_id'.
     * @return \Illuminate\Http\RedirectResponse Redirección a la página anterior.
     */
    public function miniBorrar(MiniDeleteRequest $request){
        $data = $request->validated();
        if($this->asignacionesService->miniBorrarAsignacionOrdenador($data['asignacion_id'])){
            return redirect()->back()->with('success', 'Asignación borrada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha podido borrar la asignación.');
        }
    }

    /**
     * Crea una nueva asignación de ordenador para un alumno.
     *
     * @param MiniCrearRequest $request Contiene 'alumno_id' y 'ordenador_id'.
     * @return \Illuminate\Http\RedirectResponse Redirección a la página anterior.
     */
    public function miniCrear(MiniCrearRequest $request){
        $data = $request->validated();
        if($this->asignacionesService->miniCrearAsignacionOrdenador($data)){
            return redirect()->back()->with('success', 'Asignación realizada correctamente.');
        } else{
            return redirect()->back()->with('error', 'No se ha podido realizar la asignación.');
        }
    }
}