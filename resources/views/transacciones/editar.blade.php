@extends('layouts.app')

@section('title', 'Mis Finanzas - Mis Transacciones - Editar')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection

@section('content')
<div class="container bg-light text-dark rounded p-2">
    <h3>Editar Transacción</h3>

    <form class="row g-3" method="POST" action="{{ route('transacciones.actualizar', $transaccion) }}">
        {{ csrf_field() }}
        {{ method_field('put')}}
        <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{old('descripcion', $transaccion->descripcion)}}">
            @error('descripcion')
                <p class="text-danger">{{$message}}</p>
            @enderror

        </div>
        <div class="col-md-6">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" class="form-control" name="monto" class="form-control @error('monto') is-invalid @enderror" value="{{old('monto', $transaccion->monto)}}">
            @error('monto')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{old('fecha', $transaccion->fecha)}}">
            @error('fecha')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="categoria" class="form-label">Categoría</label>
            <select id="categorias" name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror" value="{{old('categoria_id', $transaccion->categoria_id)}}">
                <option value="" selected disabled hidden>- Seleccione un valor -</option>
                @foreach($categorias as $c)
                    @if (old('categorias', $transaccion->categoria_id) == $c->id)
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
        
        <div class="row p-2 mx-auto">
            <div class="col">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
            <div class="col">
                <div class="d-grid gap-2">
                    <a href="{{ route('transacciones.index')}}" class="btn btn-secondary">
                        Cerrar
                    </a>
                </div>
            </div>
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