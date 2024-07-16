<?php

namespace App\Livewire\Components\IndexModels;

use App\Livewire\Forms\SupplierForm;
use Livewire\Component;

class SupplierIndex extends Component
{
    public $data;
    public $button_add;
    public $button_label;
    public $button_color;
    public $table_headers;
    public $actions;
    public SupplierForm $modelForm;

    public function mount($data, $button_add, $button_label, $button_color, $table_headers, $actions): void
    {
        $this->data = $data;
        $this->button_add = $button_add;
        $this->button_label = $button_label;
        $this->button_color = $button_color;
        $this->table_headers = $table_headers;
        $this->actions = $actions;
    }
    public function insert($supplierId)
    {
        $this->modelForm->insert($supplierId);

    }
    public function save()
    {
        $this->modelForm->store();
    }
    public function edit()
    {
        $this->modelForm->edit();
    }
    public function delete($supplierId)
    {
        $this->modelForm->delete($supplierId);
    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.components.index-models.supplier-index');
    }
}
