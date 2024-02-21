@extends('layout/template')

@section('title', 'Menu rutinas')

@section('content')

<main class="h-screen flex flex-col items-center">
    <a href="{{route('home.home')}}" class="justify-start mb-10 mr-auto mt-7 ml-7">
        <img class="w-32" src="{{ asset('img/logo.jpg') }}" alt="Logotipoo gestión liga">
    </a>

    <h1 class="text-center text-8xl text-gray-700 font-mono font-bold mb-10">MENÚ DE RUTINAS</h1>


    <div class="overflow-x-auto w-3/4">
        <table class="min-w-full border rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">Fecha prevista</th>
                    <th class="py-2 px-4">Tipo de rutina</th>
                    <th class="py-2 px-4">Ejercicio 1</th>
                    <th class="py-2 px-4">Ejercicio 2</th>
                    <th class="py-2 px-4">Ejercicio 3</th>
                    <th class="py-2 px-4">Ejercicio 4</th>
                    <th class="py-2 px-4">Ejercicio 5</th>
                    <th class="py-2 px-4">Ejercicio 6</th>
                    <th class="py-2 px-4"></th>
                    <th class="py-2 px-4"></th>
                </tr>
            </thead>

            <tbody class="bg-gray-200 text-center">
            @foreach($routines as $routine)
            <tr>
                <td>{{ $routine->date }}</td>
                <td>
                    @switch($routine->routine_type)
                        @case('upper_body')
                            Tronco Superior
                            @break
                        @case('lower_body')
                            Tren Inferior
                            @break
                        @case('full-body')
                            Full-body
                            @break
                        @default
                            {{ $routine->routine_type }}
                    @endswitch
                </td>
                
                @foreach($routine->exercises as $exercise)
                    <td>{{ $exercise->name }}</td>
                @endforeach
                <td>
                    <a  href="{{url('routines/'.$routine->id.'/edit')}}" class="btn btn-warning btn-sm bg-orange-200 ml-3 mr-2">Editar</a>
                </td>
                <td>
                <form action="{{ url('routines/' . $routine->id) }}" method="post" onsubmit="return confirm('¿Estás segur@ de que quieres borrar esta rutina?');">
                    @method("DELETE")
                    @csrf <!-- Genera un tocken de seguridad-->
                    <button type="submit" class="btn btn-danger btn-sm bg-red-200 mr-2">Eliminar</button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
            
    </div>
    <div class="bg-orange-300 p-2 rounded-md flex mb-20 hover:bg-gray-500 mt-5">
        <a href="{{ url ('routines/create') }}"class="btn btn-primary btn-sm">Registrar rutina</a>
    </div>



</main>


@endsection

