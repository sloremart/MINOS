<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VatPercentage extends Model
{
    use SoftDeletes;

    protected $fillable = ['percentage', 'description'];
}
