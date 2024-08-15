<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'grupo_producto',
        'sub_grupo_producto',
        'clase_producto',
        'codigo_producto',
        'nombre_producto',
        'presentacion',
        'tipo_unidad',
        'valor_venta',
        'stock',
    ];
}
