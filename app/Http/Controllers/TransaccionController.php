<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Categoria;

class TransaccionController extends Controller
{
    public function index(Request $request) {
        $transacciones = Transaccion::orderBy('fecha', 'desc')->get();
        return view('transacciones.index', compact('transacciones'));
    }

    public function crear(Request $request) {
        return view('transacciones.crear');
    }

    public function autocompletar(Request $request) {
        $data = [];
    
        if($request->filled('q')){
            $data = Categoria::select("nombre", "id")
                        ->where('nombre', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }
     
        return response()->json($data);
    }
}
