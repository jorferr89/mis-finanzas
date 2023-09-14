<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Categoria;
use App\Http\Requests\TransaccionRequest;

class TransaccionController extends Controller
{
    public function index(Request $request) {
        // filtro por fechas
        $fecha_desde= $request->fecha_desde;
        $fecha_hasta= $request->fecha_hasta;

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

        // Obtengo las Transacciones del Usuario logeado ordenado por fecha
        $consulta = Transaccion::whereUser_id(auth()->id())->orderBy('fecha', 'desc');

        // Si la fecha desde no es nula, la agrego a la consulta
        if($fecha_desde!=null)
            $consulta=$consulta->where('fecha', '>=', $fecha_desde);

        // Si la fecha hasta no es nula, la agrego a la consulta
        if($fecha_hasta!=null)
            $consulta=$consulta->where('fecha', '<=', $fecha_hasta);

        // Devuelvo las Transacciones
        $transacciones = $consulta->get();

        return view('transacciones.index', compact('transacciones', 'fecha_desde', 'fecha_hasta'));
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

    public function editar(Transaccion $transaccion) {
        if($transaccion->user->id != auth()->id())
            return redirect()->route('home');

        $categorias = Categoria::orderby('nombre', 'asc')->get();
        return view('transacciones.editar',compact('transaccion', 'categorias'));
    }

    public function actualizar(TransaccionRequest $request, Transaccion $transaccion) {
        $transaccion->update([
            'descripcion'    => $request->descripcion,
            'monto'      => $request->monto,
            'fecha'     => $request->fecha,
            'categoria_id' => $request->categoria_id,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('transacciones.index')->with('message', 'Transacción actualizada.');
    }

    public function eliminar(Transaccion $transaccion) {
        $transaccion->delete();
        return redirect()->route('transacciones.index')->with('message','Transacción eliminada.');
    }

}
