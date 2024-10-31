<?php
// ESTE MODELO COMPONEN LA TABLA DE  TIPOS DE COMERCIO  EN LA DB
namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommerceType extends Model
{
    use HasFactory;
    use PaginatorTrait;
    use ImageableTrait;

    protected $fillable = ['name'];
}
