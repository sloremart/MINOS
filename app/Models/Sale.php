<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['customer_id','user_id',  'sale_date', 'total_amount', 'details','payment_method'];

    public const PAYMENT_METHOD_CASH = "efectivo";
    public const PAYMENT_METHOD_TRANSFER = "transferencia";

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
