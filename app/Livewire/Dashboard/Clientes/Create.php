<?php

namespace App\Livewire\Dashboard\Clientes;

use App\Models\Cliente;
use App\Models\Vendedor;
use Livewire\Component;

class Create extends Component
{
    public $nombre;
    public $cedula;
    public $direccion;
    public $zona;
    public $vendedor_id;
    public $telefono;
    public $showModal = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'cedula' => 'required|string|max:255|unique:clientes',
        'direccion' => 'nullable|string|max:255',
        'zona' => 'nullable|string|max:255',
        'vendedor_id' => 'required|exists:vendedores,id',
        'telefono' => 'required|string|max:255',
    ];

    protected $message = [
        'nombre.required' => "El campo es obligatorio",
        'cedula.required' => "El campo es obligatorio",
        'direccion.required' => "El campo es obligatorio",
        'zona.required' => "El campo es obligatorio",
        'vendedor_id.required' => "El campo es obligatorio",
        'telefono.required' => "El campo es obligatorio",
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
        $this->reset(['nombre', 'cedula', 'direccion', 'zona', 'vendedor_id', 'telefono']);
    }

    public function save()
    {
        $this->validate();

        Cliente::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'direccion' => $this->direccion,
            'zona' => $this->zona,
            'vendedor_id' => $this->vendedor_id,
            'telefono' => $this->telefono,
        ]);

        $this->dispatch('cliente-created');
        $this->resetForm();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.clientes.create', [
            'vendedores' => Vendedor::all()
        ]);
    }
} 