<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class LogoutForm extends Form
{
    public function logout(): void
    {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();
    }
} 