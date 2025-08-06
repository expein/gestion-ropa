<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('livewire.dashboard.index');
    }

    public function clientes()
    {
        return view('livewire.dashboard.clientes.index');
    }

    public function productos()
    {
        return view('livewire.dashboard.productos.index');
    }

    public function facturas()
    {
        return view('livewire.dashboard.facturas.index');
    }

    public function cartera()
    {
        return view('livewire.dashboard.cartera.index');
    }

    public function vendedores()
    {
        return view('livewire.dashboard.vendedores.index');
    }
} 