<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // Tabelle für das Model
    public $table = "todos";

    // Ausfüllbaren Felder für das Model
    protected $fillable = [
        "name",
        "beschreibung",
        "datum",
        "uhrzeit"
    ];
}
