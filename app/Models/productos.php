<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable=[
        'categoria',
        'name',
        'stock',
        'unidadMedida',
        'valorU',
        'valorT',
        'barcode',
        'proveedor',
        'image',
        'proveedor_id'
    ];
    public function proveedores(){
        return $this->belongsTo(Proveedores::class);
    }
    public function getImagesAttribute(){

        if(file_exists('storage/productos/'.$this->image))
        return $this->image;
        else
        return 'noimg.jpg';
    }
   
}
