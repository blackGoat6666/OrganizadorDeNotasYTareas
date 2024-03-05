<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\ItemController;

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

Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

Route::post('/notes', [NoteController::class, 'store'])->name('note.store');

Route::get('/notes/{note}/edit', [NoteController::class, 'edit', '{note}'])->name('note.edit');

Route::put('/notes/{note}', [NoteController::class, 'update'])->name('note.update');

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('/shoppinglists', [ShoppingListController::class, 'index'])->name('shoppinglist.index');

Route::post('/shoppinglists', [ShoppingListController::class, 'store'])->name('shoppinglist.store');

Route::get('/shoppinglists/{shoppinglist}/edit', [ShoppingListController::class, 'edit', '{shoppinglist}'])->name('shoppinglist.edit');

Route::put('/shoppinglists/{shoppinglist}/update', [ShoppingListController::class, 'update'])->name('shoppinglist.update');

Route::delete('/shoppinglists/{shopinglist}', [ShoppingListController::class, 'destroy'])->name('shopinglist.destroy');

Route::post('/shoppinglists/storeItem', [ItemController::class, 'store'])->name('item.store');

Route::get('/shoppinglists/{item}/editItem', [ItemController::class, 'edit', '{item}'])->name('item.edit');

Route::put('/shoppinglists/{item}/updateItem', [ItemController::class, 'update'])->name('item.update');

Route::delete('/shoppinglists/deleteItem/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

Route::get('/tasklists', [TaskListController::class, 'index'])->name('tasklist.index');

Route::delete('/tasklists/{tasklist}', [TaskListController::class, 'destroy'])->name('tasklist.destroy');


