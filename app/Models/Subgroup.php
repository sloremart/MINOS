<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subgroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'group_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
