<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;

class TransaccionController extends Controller
{
    public function index(Request $request) {
        $transacciones = Transaccion::orderBy('fecha', 'desc')->get();
        return view('transacciones.index', compact('transacciones'));
    }

    public function crear(Request $request) {
        return view('transacciones.crear');
    }
}
