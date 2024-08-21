<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'price', 'valid_from_date', 'active'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
