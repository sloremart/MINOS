<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255|unique:products,code')]
    public $code = '';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('required|boolean')]
    public $applies_iva = true;

    #[Validate('required|exists:vat_percentages,id')]
    public $vat_percentage_id;

    #[Validate('required|exists:units,id')]
    public $unit_id;

    #[Validate('required|exists:trade_categories,id')]
    public $category_id;

    #[Validate('required|exists:subgroups,id')]
    public $subgroup_id;

    public $productId;

    public function mount($productId = null)
    {
        $this->productId = $productId;

        if ($this->productId) {
            $this->loadProduct();
        }
    }

    public function loadProduct()
    {
        $product = Product::findOrFail($this->productId);
        $this->name = $product->name;
        $this->code = $product->code;
        $this->description = $product->description;
        $this->applies_iva = $product->applies_iva;
        $this->vat_percentage_id = $product->vat_percentage_id;
        $this->unit_id = $product->unit_id;
        $this->category_id = $product->category_id;
        $this->subgroup_id = $product->subgroup_id;
    }

    public function store()
    {
        $this->validate();

        Product::create($this->all());

        session()->flash('message', 'Product successfully created.');

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->productId);
        $product->update($this->all());

        session()->flash('message', 'Product successfully updated.');
    }

    public function delete()
    {
        Product::findOrFail($this->productId)->delete();

        session()->flash('message', 'Product successfully deleted.');

        $this->reset();
    }
}
