<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request) {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('categorias.index', compact('categorias'));
    }
}
