<?php

namespace App\Livewire\Dashboard\Usuarios;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
    public $editingUserId = null;
    public $isEditing = false;

    protected $listeners = ['usuario-created' => '$refresh'];

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|exists:roles,name'
    ];

    public function render()
    {
        return view('livewire.dashboard.usuarios.index', [
            'users' => User::with('roles')->paginate(10),
            'roles' => Role::all()
        ]);
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        $this->editingUserId = $userId;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->editingUserId,
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::find($this->editingUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        if ($this->password) {
            $user->update([
                'password' => Hash::make($this->password)
            ]);
        }

        $user->syncRoles([$this->role]);

        $this->reset(['name', 'email', 'password', 'role', 'editingUserId', 'isEditing']);
        session()->flash('message', 'Usuario actualizado exitosamente.');
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        $user->delete();
        session()->flash('message', 'Usuario eliminado exitosamente.');
    }

    public function cancel()
    {
        $this->reset(['name', 'email', 'password', 'role', 'editingUserId', 'isEditing']);
    }
} 