@extends('layouts.app')

@section('title', 'Mis Transacciones - Crear')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection

@section('content')
<div class="container">
    <h1>Crear Transacción</h1>

    <form class="row g-3" method="post" action="{{route('transacciones.guardar')}}">
        @csrf
        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{old('descripcion')}}">
            @error('descripcion')
                <p class="text-danger">{{$message}}</p>
            @enderror

        </div>
        <div class="col-md-6">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" class="form-control" name="monto" class="form-control @error('monto') is-invalid @enderror" value="{{old('monto')}}">
            @error('monto')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{old('fecha')}}">
            @error('fecha')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="categoria" class="form-label">Categoría</label>
            <select id="categorias" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" value="{{old('categoria_id')}}">
                <option value="" selected disabled hidden>- Seleccione un valor -</option>
                @foreach($categorias as $c)
                    @if (old('categoria_id') == $c->id)
                        <option value="{{$c->id}}" selected>
                            {{$c->nombre}}
                        </option>
                    @else
                        <option value="{{$c->id}}">
                            {{$c->nombre}}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('categoria_id')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
            @enderror


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
    
        $('#categorias').select2({
            language: {
                noResults: function() {
                    return "No hay resultados";        
                }
            },
            delay: 250,
            cache: true
        });
    </script>
@endsection