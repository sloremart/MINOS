<?php

namespace App\Livewire;

use Livewire\Component;

class Principalindex extends Component
{
    public $paginaActual;

    public function mount()
    {
        $this->paginaActual = 'tablas.tablaIndex'; // Inicialización con el valor de tablas.tablaIndex
    }

    public function cargarTablaIndex()
    {
        $this->paginaActual = 'tablas.tablaIndex'; // Actualiza la página actual a tablas.tablaIndex
    }

    public function render()
    {
        return view('livewire.principalindex', [
            'paginaActual' => $this->paginaActual,
        ])->extends('layouts.app')
        ->section('content');
    }
}
