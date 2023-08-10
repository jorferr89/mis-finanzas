@extends('layouts.app')

@section('title', 'Mis Transacciones - Crear')

@section('content')
<div class="container">
    <h1>Crear Transacción</h1>

    @include ('layouts.mensaje')

    <form class="row g-3">
        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion">
        </div>
        <div class="col-md-6">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" class="form-control" name="monto">
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha">
        </div>
        <div class="col-md-6">
            <label for="categoria" class="form-label">Categoría</label>
            <select id="categoria" class="form-select">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary">Cerrar</button>
        </div>
    </form>

</div>
@endsection