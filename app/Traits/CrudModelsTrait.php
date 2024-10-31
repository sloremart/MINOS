<?php
// TRAITS ENCARGADO DE CONTROLAR TODOS LOS PROCEDIMIENTOS DE LOS COMPONENTES DEL SOFTWARE TANTO DE CONSULTA, REGISTRAR,EDITAR,ELIMINAR.
namespace App\Traits;

trait CrudModelsTrait
{
    public bool $isOpen = false;
    public $action = 'create';

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->action = "create";
        $this->modelForm->resetForm();
    }

    public function edit($id)
    {
        $this->action = 'edit';
        $this->modelForm->set($id);
        $this->openModal();
    }

    public function details($id)
    {
        $this->action = 'details';
        $this->modelForm->set($id);
        $this->openModal();
    }

    public function delete($id)
    {
        $this->modelForm->delete($id);
    }

    public function submitForm()
    {
        if ($this->modelForm->id != null) {
            $this->modelForm->edit();
        } else {
            $this->modelForm->store();
        }
        $this->closeModal();
    }
}
