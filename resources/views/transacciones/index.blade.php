@extends('layouts.app')

@section('title', 'Mis Transacciones')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container bg-light text-dark rounded p-2">

    <div class="d-flex justify-content-between align-items-center my-1">
        <h2 class="mb-0">Mis Transacciones</h3>
        <a href="{{ route('transacciones.crear') }}" class="btn btn-primary">
            Crear
        </a>
    </div>

    @include ('layouts.mensaje')

    <table class="table table-bordered data-table display nowrap" id="transacciones_tabla" style="width:100%">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th width="75px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transacciones as $transaccion)
                <tr>
                    <td>
                        {{ $transaccion->descripcion }}
                    </td>
                    <td> 
                        {{ $transaccion->monto }}
                    </td>
                    <td> 
                        {{ $transaccion->fecha }}
                    </td>
                    <td> 
                        @if($transaccion->categoria->tipo === '1') <span class="badge bg-info text-dark">{{ $transaccion->categoria->nombre }}</span>
                        @elseif($transaccion->categoria->tipo === '2') <span class="badge bg-danger">{{ $transaccion->categoria->nombre }}</span>
                        @elseif($transaccion->categoria->tipo === '3') <span class="badge bg-success">{{ $transaccion->categoria->nombre }}</span>
                        @elseif($transaccion->categoria->tipo === '4') <span class="badge bg-primary">{{ $transaccion->categoria->nombre }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('transacciones.editar', $transaccion)}}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminar{{$transaccion->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('transacciones.eliminar')
                    </td>
                </tr>
            @endforeach
  
        </tbody>
    </table>

</div>
@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function() {

            $('#transacciones_tabla').DataTable({
                aaSorting: [],
                pageLength : 5,
                lengthMenu: [[5, 10], [5, 10]],
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        } );


    </script>
@endsection