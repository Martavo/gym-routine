<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExercisesRoutine;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises=Exercise::all(); //te coge todos los datos de la base de datos
       $exercises = Exercise::orderBy('type')->get();
        return view('exercises.index', ['exercises' => $exercises]);
       
    }

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercises=Exercise::all(); //te coge todos los datos de la base de datos
        return view('exercises.create', ['exercises' => $exercises]); //se le pasa a la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'name' => 'required|unique:exercises|max:255',
            'type' => 'required|in:upper_body,lower_body,core,cardio',
            'description' => 'nullable',
            'material' => 'nullable',
            'video_link' => 'nullable|url',
        ], [
            'name.required' => 'El nombre del ejercicio es obligatorio.',
            'name.unique' => 'Ya existe un ejercicio con este nombre. Elige un nombre único.',
            'name.max' => 'El nombre del ejercicio no puede tener más de :max caracteres.',
            'type.required' => 'El tipo de ejercicio es obligatorio.',
            'type.in' => 'El tipo de ejercicio seleccionado no es válido.',
            'video_link.url' => 'El enlace del video debe ser una URL válida.',
            
        ]);
    
        $exercise = new Exercise();
        $exercise->name = $request->input('name');  
        $exercise->type = $request->input('type'); 
        $exercise->description = $request->input('description'); 
        $exercise->material = $request->input('material');
        $exercise->video_link = $request->input('video_link');
        $exercise->save();
        
        
        return view("exercises.message", ['msg' => "Ejercicio creado correctamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $exercise=Exercise::find($id);
        return view('exercises.edit', ['exercise' => $exercise]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([ 
            'name' => 'required|max:255',
            'type' => 'required|in:upper_body,lower_body,core,cardio',
            'description' => 'nullable',
            'material' => 'nullable',
            'video_link' => 'nullable|url',
        ], [
            'name.required' => 'El nombre del ejercicio es obligatorio.',
            'name.unique' => 'Ya existe un ejercicio con este nombre. Elige un nombre único.',
            'name.max' => 'El nombre del ejercicio no puede tener más de :max caracteres.',
            'type.required' => 'El tipo de ejercicio es obligatorio.',
            'video_link.url' => 'El enlace del video debe ser una URL válida.',
            
        ]);

        $exercise = Exercise::find($id);
        $exercise->name = $request->input('name');  
        $exercise->type = $request->input('type'); 
        $exercise->description = $request->input('description'); 
        $exercise->material = $request->input('material');
        $exercise->video_link = $request->input('video_link');
        $exercise->save();


        return view("exercises.message", ['msg' => "Ejercicio modificado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $exercise = Exercise::find($id);

    if ($exercise->routines->isEmpty()) {
        $exercise->delete();
        return view('exercises.message', ['msg' => "Ejercicio eliminado correctamente"]);
    } else {
        return view('exercises.message', ['msg' => "No puedes eliminar este ejercicio. Está asociado a una o más rutinas."]);
    }
    
}
}
