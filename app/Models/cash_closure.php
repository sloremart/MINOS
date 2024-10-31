<?php
// ESTE MODELO COMPONEN LA TABLA DE  CIERRE DE CAJA  EN LA DB
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
        'total_sales',      // Este campo debe existir
        'final_balance_cash',
        'final_balance_card',
        'final_balance',   
        'next_start_balance',
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
