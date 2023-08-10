<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TransaccionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('categorias')->group(function() {
        Route::get('', [CategoriaController::class, 'index'])->name('categorias.index');
        Route::post('crear', [CategoriaController::class, 'guardar'])->name('categorias.guardar');
        Route::put('editar/{categoria}', [CategoriaController::class, 'actualizar'])->where('categoria', '[0-9]+')->name('categorias.actualizar');
        Route::delete('eliminar/{categoria}', [CategoriaController::class, 'eliminar'])->where('categoria', '[0-9]+')->name('categorias.eliminar');
    });

    Route::prefix('mis-transacciones')->group(function() {
        Route::get('', [TransaccionController::class, 'index'])->name('transacciones.index');
        Route::get('/crear', [TransaccionController::class, 'crear'])->name('transacciones.crear');
        Route::get('autocompletar', [TransaccionController::class, 'autocompletar'])->name('autocompletar');
    });
});


