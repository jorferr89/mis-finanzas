<?php

namespace App\Http\Controllers;
use App\Models\Transaccion;
use App\Models\Categoria;

use Illuminate\Http\Request;

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
    public function index() {
        //dd("Dashboard");

        $ahorros = 0; $gastos = 0; $ingresos = 0; $inversion = 0; $monto = 0;
        $cahorros = 0; $cgastos = 0; $cingresos = 0; $cinversion = 0;
        $transacciones = Transaccion::whereUser_id(auth()->id())->get();
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

        //dd($ahorros);

        $recuentoCategoria=[1=>0, 2=>0, 3=>0, 4=>0];
        foreach ($transacciones as $t) {
            $recuentoCategoria[$t->categoria->tipo]++;
        }

        return view('home', compact ('ahorros', 'gastos', 'ingresos', 'inversion', 
                    'cahorros', 'cgastos', 'cingresos', 'cinversion',
                    'recuentoCategoria'
        ));
    }
}
