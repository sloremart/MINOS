<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['name', 'email', 'phone', 'address', 'contact','user_id', 'document'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
