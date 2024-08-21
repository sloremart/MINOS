<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = ['file_name', 'file_type', 'file_size', 'morphable_id', 'morphable_type'];

    public function morphable()
    {
        return $this->morphTo();
    }
}
