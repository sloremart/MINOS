<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;
    use SoftDeletes;
   //use PaginatorTrait;
 // use ImageableTrait;
    protected $fillable = [
        'name', 'code', 'description', 'applies_iva',
        'vat_percentage_id', 'unit_id', 'category_id', 'subgroup_id'
    ];
    public $price;
    public $quantity;

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
        return $this->hasMany(Price::class)->where('user_id', Auth::user()->id);
    }
    public function activePrice()
    {
        return $this->hasOne(Price::class)->where('active', true)->where('user_id', Auth::user()->id);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class)->where('user_id', Auth::user()->id);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_suppliers')->where('user_id', Auth::user()->id);
    }
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'product_id');
    }
}
