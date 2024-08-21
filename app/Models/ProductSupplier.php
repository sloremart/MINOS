<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSupplier extends Pivot
{
    protected $table = 'product_suppliers';

    protected $fillable = ['product_id', 'supplier_id'];
}
