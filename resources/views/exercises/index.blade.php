@extends('layout/template')

@section('title', 'Menú ejercicios')

@section('content')

<main class="h-screen flex flex-col items-center">
    <a href="{{ route('home.home') }}" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-500 ml-3 flex justify-start mb-20 mr-auto mt-3">
         Página principal
    </a>

    <h1 class="text-center text-8xl text-gray-700 font-mono font-bold mb-10">MENÚ DE EJERCICIOS</h1>


    <div class="overflow-x-auto w-3/4">
        <table class="min-w-full border rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">Tipo</th>
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Descripción</th>
                    <th class="py-2 px-4">Material</th>
                    <th class="py-2 px-4">Ejemplo</th>
                    <th class="py-2 px-4"></th>
                    <th class="py-2 px-4"></th>
                </tr>
            </thead>

            <tbody class="bg-gray-200 text-center">
            @foreach($exercises as $exercise)
                <tr>
                    <td>
                        @switch($exercise->type)
                            @case('upper_body')
                                Tronco Superior
                                @break
                            @case('lower_body')
                                Tren Inferior
                                @break
                            @case('core')
                                Core
                                @break
                            @case('cardio')
                                Cardio
                                @break
                            @default
                                {{ $exercise->type }}
                        @endswitch
                    </td>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->description }}</td>
                    <td>{{ $exercise->material }}</td>
                    <td>
                        
                        <a href="{{ $exercise->video_link }}" target="_blank">{{ $exercise->video_link }}</a>
                    </td>
                    <td><a href="{{ url('exercises/'.$exercise->id.'/edit') }}" class="btn btn-warning btn-sm bg-orange-200">Editar</a></td>
                    <td>
                        <form action="{{ url('exercises/' .$exercise->id) }}" method="post">
                            @method("DELETE")
                            @csrf <!-- Genera un tocken de seguridad-->
                            <button type="submit" class="btn btn-danger btn-sm bg-red-200">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            
    </div>
    <div class="bg-orange-300 p-2 rounded-md flex mb-20 hover:bg-gray-500 mt-5">
        <a href="{{ url ('exercises/create') }}" class="btn btn-primary btn-sm">Registrar ejercicio</a>
    </div>
</main>


@endsection



