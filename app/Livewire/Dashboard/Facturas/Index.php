<?php

namespace App\Livewire\Dashboard\Facturas;

use Livewire\Component;
use App\Models\Factura;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Facturas')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'fecha';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'fecha'],
        'sortDirection' => ['except' => 'desc'],
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
        $facturas = Factura::query()
            ->with(['cliente', 'vendedor'])
            ->when($this->search, function($query) {
                $query->where(function($query) {
                    $query->whereHas('cliente', function($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('apellido', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('vendedor', function($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('apellido', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('numero', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.dashboard.facturas.index', [
            'facturas' => $facturas
        ]);
    }
}
