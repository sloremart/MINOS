<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $fillable=['name','image'];

    public function subgrupos(){
        return $this->hasMany(Subgrupo::class,'categorias_id');
    }

    public function getImagenAttribute(){

        if(file_exists('storage/categorias/'.$this->image))

        return $this->image;
        else
        return 'noimg.jpg';
    }
}
