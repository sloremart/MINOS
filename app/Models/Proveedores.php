<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    protected $fillable=[
        'nit',
        'name',
        'phone',
        'direccion',
        'email',
        'image',
        'estatus',
    ];
    public function productos(){
        return $this->hasMany(Productos::class,'proveedor_id');
    }
    public function getImagenAttribute(){

        if(file_exists('storage/proveedores/'.$this->image))

        return $this->image;
        else
        return 'noimg.jpg';
    }
}
