<?php

namespace App\Livewire\Dashboard\Productos;

use Livewire\Component;
use App\Models\Producto;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Productos')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'nombre'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
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
        $productos = Producto::query()
            ->when($this->search, function($query) {
                $query->where(function($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                        ->orWhere('categoria', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.dashboard.productos.index', [
            'productos' => $productos
        ]);
    }
}
