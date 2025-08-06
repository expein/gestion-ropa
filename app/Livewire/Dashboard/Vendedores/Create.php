<?php

namespace App\Livewire\Dashboard\Vendedores;

use App\Models\Vendedor;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $user_id;
    public $tasa_comision;
    public $showModal = false;

    protected $rules = [
        'user_id' => 'required|exists:users,id|unique:vendedores,user_id',
        'tasa_comision' => 'required|numeric|between:0,100',
    ];

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['user_id', 'tasa_comision']);
    }

    public function save()
    {
        $this->validate();

        Vendedor::create([
            'user_id' => $this->user_id,
            'tasa_comision' => $this->tasa_comision,
            'comision_total' => 0
        ]);

        $this->dispatch('vendedor-created');
        $this->resetForm();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.vendedores.create', [
            'users' => User::whereNotIn('id', Vendedor::pluck('user_id'))->get()
        ]);
    }
} 