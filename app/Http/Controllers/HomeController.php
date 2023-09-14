<?php

namespace App\Http\Controllers;
use App\Models\Transaccion;
use App\Models\Categoria;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        
        // filtro por fechas
        $fecha_desde= $request->fecha_desde;
        $fecha_hasta= $request->fecha_hasta;
        $ahorros = 0; $gastos = 0; $ingresos = 0; $inversion = 0; $monto = 0;
        $cahorros = 0; $cgastos = 0; $cingresos = 0; $cinversion = 0;
        $disponible = 0;
        $recuentoCategoria=[1=>0, 2=>0, 3=>0, 4=>0];

        // Obtengo las Transacciones del Usuario logeado ordenado por fecha
        $consulta = Transaccion::whereUser_id(auth()->id());

        // Si fecha desde y hasta son nulas, obtengo las Transacciones de los últimos 30 días
        if($fecha_desde==null && $fecha_hasta==null){
            $unMesAtras = Carbon::now()->subDays(30);
            $consulta = $consulta->whereBetween('fecha', [$unMesAtras, now()]);
        }

        // Cantidad de Transacciones del Usuario logeado
        $cantidadTransacciones = $consulta->count();

        // Validaciones de fecha
        if($fecha_desde!=null && $fecha_hasta!=null){
            $request->validate([
                'fecha_hasta'=>'after_or_equal:fecha_desde',
                'fecha_desde'=>'before_or_equal:fecha_hasta'
                ], [
                'after_or_equal'=> 'La fecha hasta no puede ser anterior a la fecha desde',
                'before_or_equal'=> 'La fecha desde no puede ser posterior a la fecha hasta',      
            ]); 
        }

        // Si la fecha desde no es nula, la agrego a la consulta
        if($fecha_desde!=null)
            $consulta=$consulta->where('fecha', '>=', $fecha_desde);

        // Si la fecha hasta no es nula, la agrego a la consulta
        if($fecha_hasta!=null)
            $consulta=$consulta->where('fecha', '<=', $fecha_hasta);

        // Devuelvo las Transacciones
        $transacciones = $consulta->orderBy('fecha', 'desc')->get();

        // Graficas
    
        foreach ($transacciones as $t){
            if($t->categoria->tipo === '1'){
                $ahorros = $t->monto + $ahorros;
                $cahorros = $cahorros + 1;
            }
            elseif ($t->categoria->tipo === '2'){
                $gastos = $t->monto + $gastos;
                $cgastos = $cgastos + 1;
            }
            elseif($t->categoria->tipo === '3'){
                $ingresos = $t->monto + $ingresos;
                $cingresos = $cingresos + 1;
            }
            elseif($t->categoria->tipo === '4'){
                $inversion = $t->monto + $inversion;
                $cinversion = $cinversion + 1;
            }
        }

        $disponible = 0;
        $disponible = $ingresos - ($ahorros + $gastos + $inversion);

        
        foreach ($transacciones as $t) {
            $recuentoCategoria[$t->categoria->tipo]++;
        }

        return view('home', compact ('cantidadTransacciones', 'transacciones', 'fecha_desde', 'fecha_hasta', 'ahorros', 'gastos', 'ingresos', 'inversion', 
                    'cahorros', 'cgastos', 'cingresos', 'cinversion', 'disponible',
                    'recuentoCategoria'
        ));
    }
}
