<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cash_closure extends Model
{
    use HasFactory;

    // protected $table = 'cierre_cajas';

    protected $fillable = [
        'user_id',
        'closing_date_time',
        'start_balance',
        'total_sales_cash',
        'total_sales_card',
        'total_sales_transfer',
        'total_expenses',
        'final_balance_cash',
        'next_start_balance',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
