<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    use ImageableTrait;
    use PaginatorTrait;
    protected $fillable = ['name', 'contact', 'phone', 'address', 'document', 'email','user_id' ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_suppliers');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
