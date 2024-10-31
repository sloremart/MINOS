<?php
// ESTE MODELO COMPONEN LA TABLA DE  UNIDADES DE MEDIDA  EN LA DB
namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['name', 'abbreviation'];
}
