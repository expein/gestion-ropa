<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
