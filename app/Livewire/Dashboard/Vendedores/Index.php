<?php

namespace App\Livewire\Dashboard\Vendedores;

use Livewire\Component;
use App\Models\Vendedor;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Vendedores')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showConfirmModal = false;
    public $showSuccessModal = false;
    public $vendedorToDelete = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    protected $listeners = ['vendedor-created' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($vendedorId)
    {
        $this->vendedorToDelete = $vendedorId;
        $this->showConfirmModal = true;
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->vendedorToDelete = null;
    }

    public function delete()
    {
        try {
            $vendedor = Vendedor::findOrFail($this->vendedorToDelete);
            $user = $vendedor->user;
            
            // Eliminar el vendedor primero
            $vendedor->delete();
            
            // Eliminar el usuario
            $user->delete();
            
            $this->showConfirmModal = false;
            $this->vendedorToDelete = null;
            $this->showSuccessModal = true;
            
        } catch (\Exception $e) {
            $this->showConfirmModal = false;
            $this->vendedorToDelete = null;
            session()->flash('error', 'Error al eliminar el vendedor: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $vendedores = Vendedor::query()
            ->when($this->search, function($query) {
                $query->whereHas('user', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with('user')
            ->paginate($this->perPage);

        return view('livewire.dashboard.vendedores.index', [
            'vendedores' => $vendedores
        ]);
    }
}
