@extends('layout/template')

@section('title', 'Registrar rutina')

@section('content')
<main class="h-screen flex flex-col items-center">
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">¡Hay algún error en tu acción!</span>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-center text-6xl text-gray-700 font-mono font-bold mb-10 mt-10">Registrar rutina</h1>

    <div class="overflow-x-auto w-1/3 bg-gray-200 p-4 rounded-md">
        
        <form action="{{ route('routines.store') }}" method="post" class="max-w-md mx-auto">
            @csrf
            <div class="mb-4 row">
                <label for="routine_type" class="block text-gray-700 text-lg font-bold mb-2">Tipo de rutina</label>
                <div class="col-sm-5">
                    <select name="routine_type" id="routine_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="" class="text-gray-200">Seleccionar tipo de rutina</option>
                        <option value="upper_body" {{ old('routine_type') === 'upper_body' ? 'selected' : '' }}>Tren Superior</option>
                        <option value="lower_body" {{ old('routine_type') === 'lower_body' ? 'selected' : '' }}>Tren Inferior</option>
                        <option value="full-body" {{ old('routine_type') === 'full-body' ? 'selected' : '' }}>Full-body</option>
                    </select>
                </div>
            </div>
            <div class="mb-4 row">
                <label for="date" class="block text-gray-700 text-lg font-bold mb-2">Día previsto</label>
                <div class="col-sm-5">
                    <input type="date" id="date" name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
            </div>

            @for($i = 1; $i <= 6; $i++)
                <div class="mb-4 row">
                    <label for="exercise{{ $i }}" class="block text-gray-700 text-lg font-bold mb-2">Ejercicio {{ $i }}</label>
                    <div class="col-sm-5 w-full">
                        <select name="exercise{{ $i }}" id="exercise{{ $i }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="" class="text-gray-200">Seleccionar ejercicio</option>
                            @foreach($exercises as $exercise)
                                @php
                                    $selectedExercise = old('exercise' . $i);
                                @endphp
                                <option value="{{ $exercise->id }}" {{ $selectedExercise == $exercise->id ? 'selected' : '' }}>
                                    {{ $exercise->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endfor

            <div class="">
                <button type="submit" class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 my-auto rounded">Guardar</button>
                <a href="{{ route('routines.index') }}" class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 my-auto rounded">Volver</a>
            </div>
        </form>
    </div>

    <div class="mr-10 mb-10 ml-10 mt-10">
            <div class="bg-gray-200/75 p-6 rounded-md shadow-md w-93 text-center">
                <p class="text-gray-700 text-lg font-bold mb-4">Este formulario te permite registrar rutinas. 
                    Selecciona el tipo, la fecha de entrenamiento y añade 6 ejercicios para cumplir tu objetivo. 
                    ¡Guarda tu rutina y sigue construyendo un estilo de vida saludable!</p>
            </div>
    </div>
</main>
@endsection
