<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateIncidenceRequest;
use App\Http\Requests\HomeCreateIncidenceRequest;
use App\Http\Requests\IncidenceRequest;

use App\Repositories\OrdenadoresRepository as repoOrdenadores;
use App\Repositories\CursosRepository as repoCursos;
use App\Repositories\AulasRepository as repoAulas;
use App\Services\IncidenciasService;

class IncidenciasController extends Controller
{
    protected $incidenceService;

    public function __construct(IncidenciasService $incidenceService){
        $this->incidenceService = $incidenceService;
    }

    public function home(HomeCreateIncidenceRequest $request){
        $value = $request -> validated(); 
        
        return view('formulario', compact('value'));
    }

    public function create(CreateIncidenceRequest $request){
        $value = $request -> validated();

        if($this->incidenceService->create($value)){
            return redirect() -> route('asignaciones.filtrar', [
                "aula_id" => $value['aula_id'],
                "curso_id" => $value['curso_id']
            ]);
        } else {
            return redirect() -> back();
        }
    }

    public function homeAdmin(Request $request){
        $value = $request -> all();

        $incidencias = $this -> incidenceService -> getIncidencias($value);
        
        return view('admin.adminIncidencias', compact('incidencias'));
    }

    public function cambiarEstado($incidencia_id, $sin_solucion = false){
        $this -> incidenceService -> cambiarEstado($incidencia_id);

        return redirect() -> back();
    }
}
