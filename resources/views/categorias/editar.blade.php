<!-- Modal -->
<div class="modal fade" id="editar{{$categoria->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('categorias.actualizar', $categoria) }}">
            {{ csrf_field() }}
            {{ method_field('put')}}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $categoria->nombre) }}">
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
                        <div class="col-sm-10">
                        <select class="form-select @error('tipo') is-invalid @enderror" name="tipo">
                            <option value="1" {{ old('tipo', $categoria->tipo) === '1' ? 'selected' : '' }}>Ahorros</option>
                            <option value="2" {{ old('tipo', $categoria->tipo) === '2' ? 'selected' : '' }}>Gastos</option>
                            <option value="3" {{ old('tipo', $categoria->tipo) === '3' ? 'selected' : '' }}>Ingresos</option>
                        </select>
                        @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>