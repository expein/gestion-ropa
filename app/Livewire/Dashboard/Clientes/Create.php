<?php

namespace App\Livewire\Dashboard\Clientes;

use App\Models\Cliente;
use App\Models\Vendedor;
use Livewire\Component;

class Create extends Component
{
    public $nombre;
    public $numero_documento;
    public $direccion;
    public $zona;
    public $vendedor_id;
    public $telefono;
    public $showModal = false;
    public $tipo_documento = 'CC'; // Valor por defecto
    public $showAlertModal = false;
    public $alertMessage = '';
    public $alertType = 'success';

    // Propiedades para el select de búsqueda
    public $vendedorSearch = '';
    public $vendedoresFiltrados = [];
    public $showVendedorDropdown = false;
    public $vendedorSeleccionado = null;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'numero_documento' => 'required|string|max:255|unique:clientes',
        'direccion' => 'nullable|string|max:255',
        'zona' => 'nullable|string|max:255',
        'vendedor_id' => 'required|exists:vendedores,id',
        'telefono' => 'required|string|max:255',
    ];

    protected $message = [
        'nombre.required' => "El campo es obligatorio",
        'numero_documento.required' => "El campo es obligatorio",
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
        $this->reset(['nombre', 'numero_documento', 'direccion', 'zona', 'vendedor_id', 'telefono', 'vendedorSearch', 'vendedoresFiltrados', 'showVendedorDropdown', 'vendedorSeleccionado']);
        $this->tipo_documento = 'CC'; // Resetear a valor por defecto
    }

    public function updatedVendedorSearch()
    {
        if (strlen($this->vendedorSearch) >= 1) {
            try {
                $this->vendedoresFiltrados = Vendedor::with('user')
                    ->whereHas('user', function($query) {
                        $query->where('name', 'like', '%' . $this->vendedorSearch . '%');
                    })
                    ->limit(10)
                    ->get();
                $this->showVendedorDropdown = true;
            } catch (\Exception $e) {
                $this->vendedoresFiltrados = [];
                $this->showVendedorDropdown = false;
            }
        } else {
            $this->vendedoresFiltrados = [];
            $this->showVendedorDropdown = false;
        }
    }

    public function abrirDropdownVendedor()
    {
        if (empty($this->vendedorSearch)) {
            // Si no hay texto, mostrar todos los vendedores
            $this->vendedoresFiltrados = Vendedor::with('user')->limit(10)->get();
        }
        $this->showVendedorDropdown = true;
    }

    public function seleccionarVendedor($vendedorId, $nombre)
    {
        $this->vendedor_id = $vendedorId;
        $this->vendedorSeleccionado = $nombre;
        $this->vendedorSearch = $nombre;
        $this->showVendedorDropdown = false;
        $this->vendedoresFiltrados = [];
    }

    public function limpiarVendedor()
    {
        $this->vendedor_id = '';
        $this->vendedorSeleccionado = null;
        $this->vendedorSearch = '';
        $this->showVendedorDropdown = false;
        $this->vendedoresFiltrados = [];
    }

    public function closeAlertModal()
    {
        $this->showAlertModal = false;
    }

    public function save()
    {
        try {
            $this->validate();

            Cliente::create([
                'nombre' => $this->nombre,
                'tipo_documento' => $this->tipo_documento,
                'numero_documento' => $this->numero_documento,
                'direccion' => $this->direccion,
                'zona' => $this->zona,
                'vendedor_id' => $this->vendedor_id,
                'telefono' => $this->telefono,
            ]);

            $this->dispatch('cliente-created');
            $this->resetForm();
            $this->showModal = false;

            // Mostrar alerta de éxito
            $this->alertMessage = 'Cliente creado exitosamente.';
            $this->alertType = 'success';
            $this->showAlertModal = true;

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Para errores de validación, no mostrar modal, solo usar las validaciones visuales
            throw $e;
        } catch (\Exception $e) {
            // Solo mostrar alerta modal para errores del sistema, no de validación
            $this->alertMessage = 'Error al crear el cliente: ' . $e->getMessage();
            $this->alertType = 'error';
            $this->showAlertModal = true;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.clientes.create', [
            'vendedores' => Vendedor::all()
        ]);
    }
}
