<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateIncidenceRequest;
use App\Http\Requests\HomeCreateIncidenceRequest;

use App\Repositories\OrdenadoresRepository as repoOrdenadores;
use App\Services\IncidenciasService;
use App\Enums\IncidenciaStatus;
use Carbon\Carbon;

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
            ])->with('success', 'Incidencia creada correctamente.');
        } else {
            return redirect() -> back()->with('error', 'No se ha podido crear la incidencia.');
        }
    }

    public function homeAdmin(Request $request){
        $value = $request -> all();

        $estados = IncidenciaStatus::cases();

        $ordenadores = repoOrdenadores::getOrdenadores();

        $incidencias = $this -> incidenceService -> getIncidencias($value);
        
        return view('admin.adminIncidencias', compact('incidencias','value', 'ordenadores', 'estados'));
    }

    public function cambiarEstado($incidencia_id, Request $request)
    {
        $sin_solucion = $request -> input('sin_solucion', false);
        $this -> incidenceService -> cambiarEstado($incidencia_id, $sin_solucion);

        return redirect() -> back();
    }
}
