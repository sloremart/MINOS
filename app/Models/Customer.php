<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'address', 'contact','user_id'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
