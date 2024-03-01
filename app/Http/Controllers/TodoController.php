<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    protected $todo;
    public function __construct(){
        $this->todo = new Todo();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Alle Aufgaben abrufen und zurückgeben
        return $this->todo->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Neue Aufgabe erstellen und zurückgeben
        return $this->todo->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Die Aufgabe anhand der übergebenen ID finden
        $todo = $this->todo->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = $this->todo->find($id);
        
        // Überprüfe, ob 'erledigt' im Request enthalten ist, und aktualisiere es entsprechend.
        if ($request->has('erledigt')) {
            $todo->erledigt = $request->input('erledigt') === 'erledigt' ? 'erledigt' : 'nicht erledigt';
        }
        
        // Update alle anderen Felder
        $todo->update($request->except('erledigt'));
    
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Die Aufgabe anhand der übergebenen ID finden
    $todo = $this->todo->find($id);

    // Die Aufgabe löschen und das Ergebnis zurückgeben
    return $todo->delete();
}
public function deleteAllTodos()
{
    try {
        Todo::truncate(); // Alle Todos löschen
        return response()->json(['message' => 'Alle Todos erfolgreich gelöscht'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Fehler beim Löschen der Todos', 'error' => $e->getMessage()], 500);
    }
}
}
