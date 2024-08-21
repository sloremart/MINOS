<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'contact', 'phone', 'address'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_suppliers');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
