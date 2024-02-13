<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesRoutine extends Model //relacion entre ejercicios y rutinas
{
    use HasFactory;

    protected $table = 'exercises_routines';

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id'); //pertenencia a la entidad exercise, cada entrada es un ejercicio
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class, 'routine_id'); //pertenencia a la entidad exercise, cada entrada es una rutina especifica
    }
}