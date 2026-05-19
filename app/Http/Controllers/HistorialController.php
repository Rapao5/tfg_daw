<?php 

    namespace App\Http\Controllers;

    use App\Services\HistorialService;
    use App\Http\Requests\CreateHistoricoRequest;
    use Illuminate\Http\Request;
    use App\Models\OrdenadoresModel;
    use App\Models\AlumnosModel;
    use App\Models\AulasModel;
    use App\Models\CursosModel;
    use Carbon\Carbon;

    class HistorialController extends Controller {
        protected $historialService;

        public function __construct(HistorialService $historialService) {
            $this->historialService = $historialService;
        }

        /**
         * Devuelve una lista formateada para poder introducirla en una tabla
         * 
         * @param Request $request
         * @return \Illuminate\Contracts\View\View
         */
        public function home(Request $request) { 
            $data = $request->all();

            if(!isset($data['fecha_inicio'])){
                $data['fecha_inicio'] = Carbon::now() -> subdays(3) ->format('Y-m-d');
            } else {
                $data['fecha_inicio'] = Carbon::parse($data['fecha_inicio']) -> format('Y-m-d');
            }

            if(!isset($data['fecha_fin'])){
                $data['fecha_fin'] = Carbon::now() -> format('Y-m-d');
            } else {
                $data['fecha_fin'] = Carbon::parse($data['fecha_fin']) -> format('Y-m-d');
            }

            if(!isset($data['hora_inicio'])){
                $data['hora_inicio'] = Carbon::now() -> subHours(3) -> format('H:i:s');
            } else {
                $data['hora_inicio'] = Carbon::parse($data['hora_inicio']) -> format('H:i:s');
            }

            if(!isset($data['hora_fin'])){
                $data['hora_fin'] = Carbon::now() -> addHours(3) -> format('H:i:s');
            } else {
                $data['hora_fin'] = Carbon::parse($data['hora_fin']) -> format('H:i:s');
            }

            $historial = $this->historialService->getHistorico($data);

            $ordenadores = OrdenadoresModel::all();
            $alumnos = AlumnosModel::orderBy('apellidos', 'asc')->orderBy('nombre', 'asc')->get();
            $aulas = AulasModel::all();
            $cursos = CursosModel::all();

            return view('admin.historial', compact('historial', 'data', 'ordenadores', 'alumnos', 'aulas', 'cursos'));
        }

        /**
         * Registra el estado actual de las asignaciones en el histórico.
         *
         * @param CreateHistoricoRequest $request Datos necesarios para generar el histórico.
         * @return \Illuminate\Http\RedirectResponse Redirección a la página anterior.
         */
        public function historico(CreateHistoricoRequest $request){
            $data = $request->validated();
            $this -> historialService ->historico($data);
            return redirect()->back();
        }
    }