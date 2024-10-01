<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'unit_price', 'sub_total'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {

        return $this->belongsTo(Product::class,'product_id');
    }
    // Definir la relación con CashClosure
    
}
