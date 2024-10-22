<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    use HasFactory;
    protected $fillable=['name','estatus','categorias_id'];

    public function categorias(){
        return $this->hasMany(Categorias::class);
    }
}
