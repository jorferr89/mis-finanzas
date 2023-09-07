@extends('layouts.app')

@section('title', 'Mis Finanzas - Dashboard')

@section('styles')
    
@endsection

@section('content')

<div class="container bg-light text-dark rounded p-2">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-6">TOTAL DE AHORROS: $ {{ $ahorros }}</div>
        <div class="col-md-6">TOTAL DE GASTOS: $ {{ $gastos }}</div>
    </div>
    <div class="row">
        <div class="col-md-6">TOTAL DE INGRESOS: $ {{ $ingresos }}</div>
        <div class="col-md-6">TOTAL DE INVERSIÓN: $ {{ $inversion }}</div>
    </div>

    @if ($disponible > 0) <span class="badge bg-success"> + {{ $disponible }} </span>
    @else <span class="badge bg-danger"> - {{ $disponible }} </span>
    @endif
</div>

@if($cantidadTransacciones > 5)
    <div class="container bg-light text-dark rounded p-2 mt-4">
        <div id="curve_chart" style="width: auto; height: auto;"></div>
    </div>

    <div class="container bg-light text-dark rounded p-2 mt-2">
        <div class="row my-3">
            <div class="col-md-6"><div id="donutchart" style="width: auto; height: auto;"></div></div>
            <div class="col-md-6">
                <ul class="list-group">
                    <h5>Cantidad de Transacciones por Categoría</h5>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ahorros
                        <span class="badge bg-info text-dark"> {{ $cahorros }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Gastos
                        <span class="badge bg-danger"> {{ $cgastos}} </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ingresos
                        <span class="badge bg-success"> {{ $cingresos }} </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Inversión
                        <span class="badge bg-warning"> {{ $cinversion }} </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="container bg-light text-dark rounded p-2 mt-2">
        <h2>Sin datos para visualizar</h2>
    </div>

@endif

@endsection

@section('scripts')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Fecha', 'Monto'],
                @foreach($transacciones as $t)
                    ['{{DateTime::createFromFormat('Y-m-d', $t->fecha)->format('d/m/Y')}}', {{$t->monto}}],
                @endforeach
            ]);

            var formatter = new google.visualization.NumberFormat({pattern: '$#.##'});
            formatter.format(data, 1); 

            var options = {
            title: 'Montos de Transacciones',
            curveType: 'function',
            vAxis: { format:'$#.##'},
            legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);

            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Categoría', 'Cantidad'],
                ['Ahorros', {{$recuentoCategoria[1]}}],
                ['Gastos', {{$recuentoCategoria[2]}}],
                ['Inversión',  {{$recuentoCategoria[3]}}],
                ['Ingresos', {{$recuentoCategoria[4]}}]
                ]);

                var options = {
                title: 'Porcentaje de Transacciones por Categoría',
                pieHole: 0.4,
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
        }
    </script>
    
@endsection