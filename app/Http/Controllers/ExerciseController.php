<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises=Exercise::all(); //te coge todos los datos de la base de datos
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
            'name' => 'required|max:100',
            'type' => 'required|in:upper_body,lower_body,core,cardio',
            'description' => 'required',
            'material' => 'nullable',
        ]);
    
        $exercise = new Exercise();
        $exercise->name = $request->input('name');  
        $exercise->type = $request->input('type'); 
        $exercise->description = $request->input('description'); 
        $exercise->material = $request->input('material');
        $exercise->save();
        
        return redirect()->route('exercises.index')->with('msg', 'Ejercicio guardado');
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


        $request->validate([ //se colocan las reglas de la validacion del formulario
            'name' => 'required|max:100,'.$id,
            'type' => 'required|in:upper_body,lower_body,core,cardio',
            'description' => 'required',
            'material' => 'nullable',
            
        ]);

        $exercise = Exercise::find($id);
        $exercise->name = $request->input('name');  
        $exercise->type = $request->input('type'); 
        $exercise->description = $request->input('description'); 
        $exercise->material = $request->input('material');
        $exercise->save();


        return redirect()->route('exercises.index')->with('msg', 'Ejercicio modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $exercise=Exercise::find($id);
        $exercise->delete();

        return redirect("exercises");
    }
}
