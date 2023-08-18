@extends('layouts.app')

@section('title', 'Listado de Categorías')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <h1>Listado de Categorías</h1>

    @include ('layouts.mensaje')

    <!-- Botón modal "Crear Categoría -->
    <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#crear">
        Crear
    </button>

    <table class="table table-bordered data-table" id="categorias_tabla" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th width="75px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>
                        {{ $categoria->nombre }}
                    </td>
                    <td> 
                        @if($categoria->tipo === '1') <span class="badge bg-info text-dark">Ahorros</span>
                        @elseif($categoria->tipo === '2') <span class="badge bg-danger">Gastos</span>
                        @elseif($categoria->tipo === '3') <span class="badge bg-success">Ingreso</span>
                        @elseif($categoria->tipo === '4') <span class="badge bg-primary">Inversión</span>
                        @endif
                    </td>
                    <td>
                        <!-- Botón modal "Editar Categoría -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editar{{$categoria->id}}">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        @include('categorias.editar')
                        <!-- Botón modal "Editar Categoría -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminar{{$categoria->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @include('categorias.eliminar')
                    </td>
                </tr>
            @endforeach
  
        </tbody>
    </table>

    @include('categorias.crear')

</div>
@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function() {

            $('#categorias_tabla').DataTable({
                aaSorting: [],
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