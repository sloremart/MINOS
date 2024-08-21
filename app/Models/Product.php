<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'code', 'description', 'applies_iva',
        'vat_percentage_id', 'unit_id', 'category_id', 'subgroup_id'
    ];

    public function vatPercentage()
    {
        return $this->belongsTo(VatPercentage::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subgroup()
    {
        return $this->belongsTo(Subgroup::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_suppliers');
    }
}
