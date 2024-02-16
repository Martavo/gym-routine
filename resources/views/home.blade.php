@extends('layout/template')

@section('title', 'Gym Routine')

@section('content')

<main class="h-screen flex items-center justify-center">
    <div class="text-8xl font-mono">
        <h1 class="text-center mb-10 font-bold">Bienvenid@ a Gym Routine</h1>

        <div class="flex flex-col items-center space-y-8 mt-4">
            
            <div class="bg-orange-300 p-10 rounded-md mt-5">
                <a href="{{ route('exercises.index') }}" class="text-4xl block text-center underline">EJERCICIOS</a>
            </div>

            <div class="bg-orange-300 p-10 rounded-md">
                <a href="{{ route('routines.index') }}" class="text-4xl block text-center underline">RUTINAS DE ENTRENAMIENTO</a>
            </div>
        </div>

    </div>
</main>

@endsection