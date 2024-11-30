<?php
// ------------------->POR MEDIO DE ESTE COMPONENTE  PODEMOS AGREGAR LOS PRODUCTOS , ELIMINARLOS, EDITARLOS, ESTE COMPONENTE PREPARA LOS PRODUCTOS PARA SU COMPRA  Y VENTA <-----------------------/////
namespace App\Livewire\Forms;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\VatPercentage;
use App\Models\Unit;
use App\Models\Subgroup;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('unique:products,code')]
    public $code = '';
    #[Validate('unique:products,code')]

    #[Validate('nullable')]
    public $description = '';

    #[Validate('required')]
    public $price = '';
    //#[Validate('required')]
    public $total = '';
   // #[Validate('required')]
    public $subtotal = '';
    #[Validate('required')]
    public $quantity ='';
    //#[Validate('required|numeric|lt:quantity')]
    public $number = '';
    #[Validate('required|boolean')]
    public $applies_iva = false;

    #[Validate('required|exists:vat_percentages,id')]
    public $vat_percentage_id = null;

    #[Validate('required|exists:units,id')]
    public $unit_id = null;

    #[Validate('required|exists:subgroups,id')]
    public $subgroup_id = null;

    public function set($id)
    {
        $model = Product::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->code = $model->code;
            $this->description = $model->description;
            $this->applies_iva = $model->applies_iva;
            $this->vat_percentage_id = $model->vat_percentage_id;
            $this->unit_id = $model->unit_id;
            $this->price = $model->activePrice ? $model->activePrice->price : 0;
            // $this->price = $model->activePrice?->price  ?? 10;
            $this->quantity = $model->inventory ? $model->inventory->quantity : 0;
            $this->subgroup_id = $model->subgroup_id;
            $this->number = 1;
            $this->subtotal = $this->number * $this->price;
            $this->total = $this->subtotal + (($this->subtotal*$model->vatPercentage->percentage/100));
        }
    }

    public function store()
    {
        $this->validate(); // Validar los datos del formulario
    
        // Crear un nuevo producto asignando el ID del usuario autenticado
        $product = new Product();
        $product->name = $this->name;
        $product->code = $this->code;
        $product->description = $this->description;
        $product->applies_iva = $this->applies_iva;
        $product->vat_percentage_id = $this->vat_percentage_id;
        $product->unit_id = $this->unit_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->subgroup_id = $this->subgroup_id;
        $product->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $product->save();
    
        // Mensaje de éxito
        session()->flash('message', 'Producto creado correctamente.');
        return redirect('/productos/listado'); // Redirigir a la lista de productos
    }

    public function edit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'code' => [
                'required',
                'min:3',
                Rule::unique('products', 'code')->ignore($this->id),
            ],
            'description' => 'nullable|min:5',
            'price' => 'nullable|numeric|min:0', // Valida el precio como parte de la relación
            'quantity' => 'nullable|integer|min:0', // Valida la cantidad como parte del inventario
            'unit_id' => 'required|exists:units,id',
            'subgroup_id' => 'required|exists:subgroups,id',
        ]);
    
        $model = Product::find($this->id);
    
        if ($model) {
            // Actualiza los datos del producto
            $model->update([
                'name' => $this->name,
                'description' => $this->description,
                'applies_iva' => $this->applies_iva,
                'vat_percentage_id' => $this->vat_percentage_id,
                'unit_id' => $this->unit_id,
                'subgroup_id' => $this->subgroup_id,
            ]);
    
            // Actualiza el precio activo (si corresponde)
            if ($this->price !== null) {
                $activePrice = $model->activePrice; // Obtiene el precio activo
                if ($activePrice) {
                    $activePrice->update(['price' => $this->price]);
                } else {
                    $model->prices()->create([
                        'price' => $this->price,
                        'active' => true,
                        'user_id' => Auth::user()->id,
                        'valid_from_date' => Carbon::now(), // Asignamos la fecha actual
                    ]);
                }
            }
    
            // Actualiza la cantidad en inventario (si corresponde)
            if ($this->quantity !== null) {
                $inventory = $model->inventory; // Obtiene el inventario
                if ($inventory) {
                    $inventory->update(['quantity' => $this->quantity]);
                } else {
                    $model->inventory()->create([
                        'quantity' => $this->quantity,
                        'user_id' => Auth::user()->id,
                        'last_updated_date' => Carbon::now(), // Asignamos la fecha actual
                    ]);
                }
            }
    
            // Notificar éxito
            $this->resetForm();
            session()->flash('message', 'Producto actualizado correctamente.');
            return redirect('/productos/listado');
        }
    
        // Producto no encontrado
        session()->flash('error', 'Producto no encontrado.');
    }
    

    public function delete($id)
    {
        $model = Product::find($id);
        if ($model) {
            // $model->forceDelete();
            $model->delete();
            session()->flash('message', 'Producto eliminado correctamente.');
        }
     

        $model1 = Inventory::find($id);
        if ($model1) {
            $model1->delete();
            // $model->forceDelete();
            session()->flash('message', 'Producto eliminado correctamente.');
        }
        return redirect('/productos/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'description', 'applies_iva', 'vat_percentage_id', 'unit_id', 'subgroup_id']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'code.required' => 'El código es obligatorio.',
            'number.required' => 'El código es obligatorio.',
            'number.lt' => 'La cantidad debe ser menor al stock disponible.',
            'code.unique' => 'El código ya está registrado.',
            'applies_iva.required' => 'Debes indicar si aplica IVA.',
            'vat_percentage_id.required' => 'El porcentaje de IVA es obligatorio.',
            'vat_percentage_id.exists' => 'El porcentaje de IVA seleccionado no existe.',
            'unit_id.required' => 'La unidad es obligatoria.',
            'unit_id.exists' => 'La unidad seleccionada no existe.',
            'subgroup_id.required' => 'El subgrupo es obligatorio.',
            'subgroup_id.exists' => 'El subgrupo seleccionado no existe.',
        ];
    }
}
