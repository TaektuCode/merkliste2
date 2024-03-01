<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ressourcenroute für die Todo-Controller-Klasse erstellen
Route::apiResource('/todo', TodoController::class); 
// Route zum Löschen aller Todos durch die Methode 'deleteAllTodos' im TodoController
Route::delete('/todos', [TodoController::class, 'deleteAllTodos']); 