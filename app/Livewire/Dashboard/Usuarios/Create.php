<?php

namespace App\Livewire\Dashboard\Usuarios;

use App\Models\User;
use App\Models\Vendedor;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $tasa_comision;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|exists:roles,name',
        'tasa_comision' => 'required_if:role,vendedor|numeric|between:0,100',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'El email debe tener un formato válido.',
        'email.unique' => 'Este email ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'role.required' => 'El rol es obligatorio.',
        'role.exists' => 'El rol seleccionado no es válido.',
        'tasa_comision.required_if' => 'La tasa de comisión es obligatoria para vendedores.',
        'tasa_comision.numeric' => 'La tasa de comisión debe ser un número.',
        'tasa_comision.between' => 'La tasa de comisión debe estar entre 0 y 100.',
    ];

    public function updated($field)
    {
        // Validaciones rápidas sin consultas a BD para campos simples
        if (in_array($field, ['name', 'password', 'role'])) {
            $this->validateOnly($field);
        }
        
        // Validación especial para email (solo si tiene formato válido)
        if ($field === 'email' && filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->validateOnly($field);
        }
        
        // Validación especial para confirmación de contraseña
        if ($field === 'password_confirmation' && $this->password) {
            $this->validateOnly('password');
        }

        // Validación para tasa de comisión cuando el rol es vendedor
        if ($field === 'tasa_comision' && $this->role === 'vendedor') {
            $this->validateOnly('tasa_comision');
        }
    }

    public function updatedRole()
    {
        $this->validateOnly('role');
        // Limpiar tasa de comisión si no es vendedor
        if ($this->role !== 'vendedor') {
            $this->tasa_comision = '';
        }
    }

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role', 'tasa_comision']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Asignar el rol
        $user->assignRole($this->role);

        // Si es vendedor, crear el registro de vendedor
        if ($this->role === 'vendedor') {
            Vendedor::create([
                'user_id' => $user->id,
                'tasa_comision' => $this->tasa_comision,
                'comision_total' => 0
            ]);
        }

        $this->dispatch('usuario-created');
        $this->resetForm();
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard.usuarios.create', [
            'roles' => Role::all()
        ]);
    }
} 