<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;

    protected $fillable = ['product_id','user_id', 'price', 'valid_from_date', 'active'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
