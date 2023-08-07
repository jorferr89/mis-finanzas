<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    public function index(Request $request) {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function guardar(CategoriaRequest $request){
        $categoria = Categoria::create([
            'nombre'    => $request->nombre,
            'tipo'      => $request->tipo,
        ]);
        return redirect()->route('categorias.index')->with('message', 'Categoría guardada.');
    }

    public function actualizar(CategoriaRequest $request, Categoria $categoria) {
        $categoria->update([
            'nombre'    => $request->nombre,
            'tipo'      => $request->tipo,
        ]);
        return redirect()->route('categorias.index')->with('message','Categoría actualizada.');
    }

    public function eliminar(Categoria $categoria) {
        // referencias se ocupará para ver si la Categoría a eliminar está asociada con alguna Transacción
        $references = 1;

        if ($references > 0) 
            return redirect()->route('categorias.index')->withErrors('No se puede eliminar la Categoría porque hay registros asociados');
        
        $categoria->delete();
        return redirect()->route('categorias.index')->with('message','Categoría eliminada.');
    }
}