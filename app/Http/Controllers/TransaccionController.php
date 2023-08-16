<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Categoria;
use App\Http\Requests\TransaccionRequest;

class TransaccionController extends Controller
{
    public function index(Request $request) {
        $transacciones = Transaccion::orderBy('fecha', 'desc')->get();
        return view('transacciones.index', compact('transacciones'));
    }

    public function crear(Request $request) {
        $categorias = Categoria::orderby('nombre', 'asc')->get();
        //dd($categorias);
        return view('transacciones.crear', compact('categorias'));
    }

    public function guardar(TransaccionRequest $request){
        $transaccion = Transaccion::create([
            'descripcion'    => $request->descripcion,
            'monto'      => $request->monto,
            'fecha'     => $request->fecha,
            'categoria_id' => $request->categoria_id,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('transacciones.index')->with('message', 'Transacción guardada.');
    }
}
