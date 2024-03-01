<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('notes.index');

Route::get('/notes/create', [DragonController::class, 'create'])->name('note.create');

Route::post('/notes/{note}', [DragonController::class, 'store'])->name('note.store');

Route::get('/notes/{note}/edit', [NoteController::class, 'edit', '{note}'])->name('note.edit');

Route::put('/notes/{note}', [NoteController::class, 'update'])->name('note.update');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');


