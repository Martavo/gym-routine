@extends('layout/template')

@section('title', 'Menu rutinas')

@section('content')

<main class="h-screen flex flex-col items-center">
    <a href="{{ route('home.home') }}" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-500 ml-3 flex justify-start mb-20 mr-auto mt-3">
         Página principal
    </a>

    <h1 class="text-center text-8xl text-gray-700 font-mono font-bold mb-10">MENÚ DE RUTINAS</h1>


    <div class="overflow-x-auto w-3/4">
        <table class="min-w-full border rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Tipo de rutina</th>
                    <th class="py-2 px-4">Fecha planificada</th>
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
                <td>{{ $routine->id }}</td>
                <td>{{ $routine->routine_type }}</td>
                <td>{{ $routine->date }}</td>
                
                @foreach($routine->exercises as $exercise)
                    <td>{{ $exercise->name }}</td>
                @endforeach
                <td>
                    <a  href="{{url('routines/'.$routine->id.'/edit')}}" class="btn btn-warning btn-sm bg-orange-200">Editar</a>
                </td>
                <td>
                    <form action="{{url ('routines/' .$routine->id)}}" method="post">
                        @method("DELETE")
                        @csrf <!-- Genera un tocken de seguridad-->
                        <button type="submit" class = "btn btn-danger btn-sm bg-red-200">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
            
    </div>
    <div class="bg-orange-300 p-2 rounded-md flex mb-20 hover:bg-gray-500">
        <a href="{{ url ('routines/create') }}"class="btn btn-primary btn-sm">Registrar rutina</a>
    </div>
</main>


@endsection

