@extends('layout/template')

@section('title', 'Registrar ejercicio')

@section('contenido')

<main>
    <div class="container py-4">
    <h2>{{ $msg }}</h2>

    <a href="{{ url('exercises') }}" class="btn btn-secondary xl"></a>

    </div>
</main>