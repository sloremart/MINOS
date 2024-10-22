<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['supplier_id', 'user_id', 'purchase_date', 'total_amount','payment_method', 'details'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productPurchases()
    {
        return $this->hasMany(ProductPurchase::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
