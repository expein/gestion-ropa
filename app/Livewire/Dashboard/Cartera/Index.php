<?php

namespace App\Livewire\Dashboard\Cartera;

use Livewire\Component;
use App\Models\Cartera;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cartera')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'updated_at'],
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
        $carteras = Cartera::query()
            ->with('cliente')
            ->when($this->search, function($query) {
                $query->where(function($query) {
                    $query->whereHas('cliente', function($q) {
                        $q->where('nombre', 'like', '%' . $this->search . '%')
                          ->orWhere('apellido', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.dashboard.cartera.index', [
            'carteras' => $carteras
        ]);
    }
}
