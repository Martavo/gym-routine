<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Exercise;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $routines = Routine::with('exercises')->get();

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
            'date' => 'required',
           
        ]);

        
        $routine = new Routine();
        $routine->routine_type = $request->input('routine_type');
        $routine->date = $request->input('date');
        $routine->save();

    
        $selectedExercises = [];

        for ($i = 1; $i <= 6; $i++) {
            $selectedExerciseId = $request->input('exercise' . $i);

            if (!empty($selectedExerciseId)) {
                $selectedExercises[] = $selectedExerciseId;
            }
        }

        $routine->exercises()->attach($selectedExercises);

        return redirect()->route('routines.index')->with('msg', 'Rutina guardada correctamente');
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
            'date' => 'required',
        ]);

        $routine = Routine::find($id);
        $routine->routine_type = $request->input('routine_type');
        $routine->date = $request->input('date');
        $routine->save();

       
        $selectedExercises = [];

        for ($i = 1; $i <= 6; $i++) {
            $selectedExerciseId = $request->input('exercise' . $i);

            if (!empty($selectedExerciseId)) {
                $selectedExercises[] = $selectedExerciseId;
            }
        }

        
        $routine->exercises()->sync($selectedExercises);

        return redirect()->route('routines.index')->with('msg', 'Rutina actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $routine=Routine::find($id);
        $routine->delete();

        return redirect("routines");
    }
}
