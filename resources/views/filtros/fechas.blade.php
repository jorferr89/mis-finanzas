<div class="row g-3 align-items-center bg-light">
  <div class="col-2">
    <label for="desde" class="col-form-label">Desde</label>
  </div>
  <div class="col-3">
    <input type="date" class="form-control" type="date" name="fecha_desde" id='fecha_desde' class="form-control @error('fecha_desde') is-invalid @enderror" value="{{old('fecha_desde', $fecha_desde)}}">
  </div>
  <div class="col-2">
    <label for="hasta" class="col-form-label">Hasta</label>
  </div>
  <div class="col-3">
    <input type="date" class="form-control" type="date" name="fecha_hasta" id='fecha_hasta' class="form-control @error('fecha_hasta') is-invalid @enderror" value="{{old('fecha_hasta', $fecha_hasta)}}">
  </div>
  <div class="col-2">
    <button class="btn btn-outline-dark" type="submit">Filtrar</button>
  </div>
</div>