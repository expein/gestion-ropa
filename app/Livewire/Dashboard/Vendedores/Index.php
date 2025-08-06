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

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    protected $listeners = ['vendedor-created' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
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
