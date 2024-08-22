<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetail extends Model
{
    use HasFactory, SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_price',
        'sub_total',
    ];

    /**
     * Relación con el modelo Purchase.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    /**
     * Relación con el modelo Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
