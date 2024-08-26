<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use App\Traits\PaginatorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VatPercentage extends Model
{
    use SoftDeletes;
    use PaginatorTrait;
    use ImageableTrait;
    protected $fillable = ['percentage', 'description'];
}
