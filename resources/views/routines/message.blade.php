@extends('layout/template')

@section('title', 'Mensaje confirmacion')

@section('content')
<main class="h-screen flex items-center justify-center bg-white bg-opacity-70">
    <div class="bg-white p-8 rounded-md">
        <h1 class="text-center text-2xl font-bold mb-4">MENSAJE DE VALIDACIÓN</h1>
        <div class="text-center text-gray-500 mb-4">
            <p>{{ $msg }}</p>
        </div>
        <button class="bg-orange-400 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
            <a href="{{ url('routines') }}">Volver</a>
        </button>
    </div>
</main>
@endsection

