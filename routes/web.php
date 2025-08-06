<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\Clientes\Index as ClientesIndex;
use App\Livewire\Dashboard\Productos\Index as ProductosIndex;
use App\Livewire\Dashboard\Facturas\Index as FacturasIndex;
use App\Livewire\Dashboard\Cartera\Index as CarteraIndex;
use App\Livewire\Dashboard\Vendedores\Index as VendedoresIndex;
use App\Livewire\Dashboard\Usuarios\Index as UsuariosIndex;

Route::redirect('/', '/dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/dashboard/clientes', ClientesIndex::class)->name('dashboard.clientes');
    Route::get('/dashboard/productos', ProductosIndex::class)->name('dashboard.productos');
    Route::get('/dashboard/facturas', FacturasIndex::class)->name('dashboard.facturas');
    Route::get('/dashboard/cartera', CarteraIndex::class)->name('dashboard.cartera');
    Route::get('/dashboard/vendedores', VendedoresIndex::class)->name('dashboard.vendedores');
    
    // Rutas para administradores
    Route::get('/dashboard/usuarios', UsuariosIndex::class)
        ->middleware(\Spatie\Permission\Middleware\RoleMiddleware::class.':admin')
        ->name('dashboard.usuarios');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
