<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologias extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_uni',
        'abreviatura', // Incluye otros atributos que desees permitir
        'estatus' // Incluye otros atributos que desees permitir
    ];
}
