<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type',
        'name',
        'tax_id',
        'legal_address',
        'phone_number',
        'email',
        'morphable_id',
        'morphable_type',
    ];
}
