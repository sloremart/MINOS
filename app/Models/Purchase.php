<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = ['supplier_id', 'purchase_date', 'total_amount', 'details'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productPurchases()
    {
        return $this->hasMany(ProductPurchase::class);
    }
}
