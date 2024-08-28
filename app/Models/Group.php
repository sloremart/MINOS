<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['name', 'description', 'code'];

    public function subgroups()
    {
        return $this->hasMany(Subgroup::class);
    }
}
