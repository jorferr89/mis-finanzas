@extends('layouts.app')

@section('title', 'Mis Transacciones - Crear')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection

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
            <select id="categorias" class="form-select" name="categoria_id"></select>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary">Cerrar</button>
        </div>
    </form>

</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">
        var path = "{{ route('autocompletar') }}";
    
        $('#categorias').select2({
            language: {
                noResults: function() {
                    return "No hay resultados";        
                },
                searching: function() {
                    return "Buscando...";
                }
            },
            placeholder: 'Seleccione una Categoría',
            ajax: {
            url: path,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                results:  $.map(data, function (item) {
                        return {
                            text: item.nombre,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
            }
        });
    
    </script>
@endsection