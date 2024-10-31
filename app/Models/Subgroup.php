<?php
// ESTE MODELO COMPONEN LA TABLA DE  SUBGRUPOS  EN LA DB
namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subgroup extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['name', 'description', 'group_id', 'code'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
