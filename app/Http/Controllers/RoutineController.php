<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Routine;
use App\Models\Exercise;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $routines = Routine::with('exercises')->get();
        $routines = Routine::all()->sortBy('date');

        return view('routines.index', [
            'routines' => $routines,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercises = Exercise::all();
        $routines = Routine::all();
    
        return view('routines.create', [
            'exercises' => $exercises,
            'routines' => $routines,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'routine_type' => 'required|in:upper_body,lower_body,full-body',
        'date' => 'required|date|after_or_equal:today',
        'exercises.*' => 'required|exists:exercises,id',
    ], [
        'routine_type.required' => 'El tipo de rutina es obligatorio.',
        'routine_type.in' => 'El tipo de rutina seleccionado no es válido.',
        'date.required' => 'La fecha es obligatoria.',
        'date.date' => 'La fecha no tiene un formato válido.',
        'date.after_or_equal' => 'La fecha debe ser hoy o en el futuro.',
        'exercises.*.required' => 'Cada ejercicio es obligatorio.',
        'exercises.*.exists' => 'El ejercicio seleccionado no es válido.',
    ]);

    
        $selectedExercises = [];

    for ($i = 1; $i <= 6; $i++) {
        $exerciseId = $request->input('exercise' . $i);

        if (in_array($exerciseId, $selectedExercises)) {
            return redirect()->back()->withErrors(['exercises' => 'No puedes agregar el mismo ejercicio más de una vez.'])->withInput();
        }

        $exerciseType = Exercise::find($exerciseId)->type;
        $routineType = $request->input('routine_type');

        if($routineType !== "full-body"){
            if($routineType !== $exerciseType){
                return redirect()->back()->withErrors(['exercises' => 'El ejercicio seleccionado no es válido para el tipo de rutina seleccionado.'])->withInput();
            }
        }
    
        $selectedExercises[] = $exerciseId;
    }
    
    
    $routine = new Routine();
    $routine->routine_type = $request->input('routine_type');
    $routine->date = $request->input('date');
    $routine->save();
    
    $routine->exercises()->attach($selectedExercises);
    
    return view("routines.message", ['msg' => "Rutina creada correctamente"]);
}

    /**
     * Display the specified resource.
     */
    public function show(Routine $routine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $routine = Routine::findOrFail($id);
        $exercises = Exercise::all();
    
        return view('routines.edit', [
            'routine' => $routine,
            'exercises' => $exercises,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'routine_type' => 'required|in:upper_body,lower_body,full-body',
            'date' => 'required|date|after_or_equal:today',
            'exercises.*' => 'required|exists:exercises,id',
        ], [
            'routine_type.required' => 'El tipo de rutina es obligatorio.',
            'routine_type.in' => 'El tipo de rutina seleccionado no es válido.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha no tiene un formato válido.',
            'date.after_or_equal' => 'La fecha debe ser hoy o en el futuro.',
            'exercises.*.required' => 'Cada ejercicio es obligatorio.',
            'exercises.*.exists' => 'El ejercicio seleccionado no es válido.',
        ]);

        $routine = Routine::find($id);
        $routine->routine_type = $request->input('routine_type');
        $routine->date = $request->input('date');
        $routine->save();

        $newExerciseIds = [];

        for ($i = 1; $i <= 6; $i++) {
            $selectedExerciseId = $request->input('exercise' . $i);

            if (!empty($selectedExerciseId) && !in_array($selectedExerciseId, $newExerciseIds)) {
                $newExerciseIds[] = $selectedExerciseId;
            } elseif (in_array($selectedExerciseId, $newExerciseIds)) {
                return redirect()->back()->withErrors(['exercises' => 'No puedes agregar el mismo ejercicio más de una vez.'])->withInput();
            }

            $exerciseType = Exercise::find($selectedExerciseId)->type;
            $routineType = $request->input('routine_type');

            if($routineType !== "full-body"){
                if($routineType !== $exerciseType){
                    return redirect()->back()->withErrors(['exercises' => 'El ejercicio seleccionado no es válido para el tipo de rutina seleccionado.'])->withInput();
                }
            }
        }

        $routine->exercises()->detach();
        $routine->exercises()->attach($newExerciseIds);

        return view("routines.message", ['msg' => "Rutina modificada correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $routine=Routine::find($id);
        $routine->delete();

        return view("routines.message", ['msg' => "Rutina eliminada correctamente"]);
    }
}
