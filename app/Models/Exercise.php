<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'exercises_routines'); //establece una relación muchos a muchos con la entidad Routine
                                                                            
    }
}