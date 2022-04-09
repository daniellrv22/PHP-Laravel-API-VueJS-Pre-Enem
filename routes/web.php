<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/disciplinas', function() {
    return view('app.disciplinas');
})->name('disciplinas')->middleware('auth');

Route::get('/alunos', function() {
    return view('app.alunos');
})->name('alunos')->middleware('auth');

Route::get('/professores', function() {
    return view('app.professores');
})->name('professores')->middleware('auth');

Route::get('/turmas', function() {
    return view('app.turmas');
})->name('turmas')->middleware('auth');
