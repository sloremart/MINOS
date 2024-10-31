<?php
// TRAITS PAR CONTROLAR EL PAGINADOR DE CADA TABLA  EXISTENTE EN EL SOFTWARE
namespace App\Traits;

use App\Scope\PaginationScope;

trait PaginatorTrait
{
    public function scopePagination($query)
    {
        return $query->paginate(PaginationScope::PAGE_SIZE);
    }
}
