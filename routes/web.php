<?php
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/home', [HomeController::class, 'home'])->name('home.home');

Route::resource('/exercises', ExerciseController::class)->names('exercises');//rutas para exercises

Route::resource('/routines', RoutineController::class)->names('routines');; //rutas para routines


