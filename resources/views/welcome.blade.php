@extends('layouts.app')

@section('title', 'Mis Finanzas')

@section('styles')
    
@endsection

@section('content')

<div class="container bg-light text-dark rounded p-2">
    <div class="row">
        <div class="col">
            <h2 align="center">Mis Finanzas</h2>
            <hr>
            <p class="lead text-secondary">
                Administre sus Finanzas en cualquier lugar y desde cualquier dispositivo. 
            </p>
            <p class="lead text-secondary">
                Registre sus Transacciones y lleve un control de su dinero. 
            </p>
        </div>
        <div class="col" style="text-align: center;">
            @guest
                <div class="d-grid gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        Ingresar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        Registrarme
                    </a>
                </div>

            @else

                <div class="d-grid gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        Ir a Inicio
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="btn btn-outline-danger">
                        Salir
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest

            <img class="img-fluid mb-4" src="finanzas.jpg" style="width: auto; height: auto;">

        </div>
    </div>
</div>

@endsection

@section('scripts')
    
@endsection