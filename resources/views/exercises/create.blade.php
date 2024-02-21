@extends('layout/template')

@section('title', 'Registrar Ejercicio')

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

    <h1 class="text-center text-6xl text-gray-700 font-mono font-bold mb-10 mt-10">Registrar ejercicio</h1>

    <div class="overflow-x-auto w-1/3 bg-gray-200 p-4 rounded-md">
        <form action="{{ url('exercises') }}" method="post" class="max-w-md mx-auto">
            @csrf
            <div class="mb-4 row">
                <label for="name" class="block text-gray-700 text-lg font-bold mb-2">Nombre del Ejercicio</label>
                    <div class="col-sm-5">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ old('name') }}" placeholder="Introduce el nombre del ejercicio" required>
                    </div>
            </div>
            <div class="mb-4 row">
                <label for="type" class="block text-gray-700 text-lg font-bold mb-2">Tipo de Ejercicio</label>
                    <div class="col-sm-5">
                        <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="" class="text-gray-200">Seleccionar nivel</option>
                            <option value="upper_body" {{ old('type') === 'upper_body' ? 'selected' : '' }}>Tren Superior</option>
                            <option value="lower_body" {{ old('type') === 'lower_body' ? 'selected' : '' }}>Tren Inferior</option>
                            <option value="core" {{ old('type') === 'core' ? 'selected' : '' }}>Core</option>
                            <option value="cardio" {{ old('type') === 'cardio' ? 'selected' : '' }}>Cardio</option>
                        </select>
                    </div>
            </div>
            <div class="mb-4 row">
                <label for="description" class="block text-gray-700 text-lg font-bold mb-2">Descripción del Ejercicio</label>
                        <div class="col-sm-5">
                                <textarea class="resize-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Introduce la descripción del ejercicio">{{ old('description') }}</textarea>
                        </div>
            </div>
            <div class="mb-4 row">
                <label for="material" class="block text-gray-700 text-lg font-bold mb-2">Material Necesario</label>
                        <div class="col-sm-5 w-full">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="material" name="material" value="{{ old('material') }}" placeholder="Introduce el material necesario" >
                        </div>
            </div>
            <div class="mb-4 row">
                <label for="video_link" class="block text-gray-700 text-lg font-bold mb-2">Enlace de Video</label>
                <div class="col-sm-5">
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="video_link" name="video_link" value="{{ old('video_link') }}" placeholder="Introduce el enlace del video de YouTube">
                </div>
            </div>
            <div class="">
                <button type="submit" class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 my-auto rounded">Guardar</button>
                    <a href="{{ url('exercises') }}" class="bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 my-auto rounded">Volver</a>
            </div>
        </form>    

    </div>
    <div class="mr-10 mb-auto ml-10 mt-10">
            <div class="bg-gray-200/75 p-6 rounded-md shadow-md w-93 text-center">
                <p class="text-gray-700 text-lg font-bold mb-4">Este formulario te permite registrar ejercicios. 
                    Selecciona el nombre, el tipo y añade si quieres una descripción, material y video. 
                    ¡Guarda tus ejercicios para crear grandes rutinas de entrenamiento!</p>
            </div>
    </div>
    
</main>
@endsection