<?php

namespace App\Livewire\Dashboard\Clientes;

use Livewire\Component;
use App\Models\Cliente;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Clientes')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $showConfirmModal = false;
    public $showSuccessModal = false;
    public $clienteToDelete = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'nombre'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    protected $listeners = ['cliente-created' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($clienteId)
    {
        $this->clienteToDelete = $clienteId;
        $this->showConfirmModal = true;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->clienteToDelete = null;
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
    }

    public function delete()
    {
        try {
            $cliente = Cliente::findOrFail($this->clienteToDelete);
            $cliente->delete();
            
            $this->showConfirmModal = false;
            $this->clienteToDelete = null;
            $this->showSuccessModal = true;
            
        } catch (\Exception $e) {
            $this->showConfirmModal = false;
            $this->clienteToDelete = null;
            
            if ($e instanceof \Illuminate\Database\QueryException && $e->getCode() == 23000) {
                session()->flash('error', 'No se puede eliminar el cliente porque tiene facturas, cartera o abonos asociados.');
            } else {
                session()->flash('error', 'Error al eliminar el cliente: ' . $e->getMessage());
            }
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $clientes = Cliente::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('numero_documento', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('telefono', 'like', '%' . $this->search . '%')
                        ->orWhere('direccion', 'like', '%' . $this->search . '%')
                        ->orWhere('zona', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.dashboard.clientes.index', [
            'clientes' => $clientes
        ]);
    }
}
