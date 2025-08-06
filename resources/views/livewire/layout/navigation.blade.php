<?php

use App\Livewire\Forms\LogoutForm;
use Livewire\Volt\Component;

new class extends Component
{
    public LogoutForm $form;

    /**
     * Log the current user out of the application.
     */
    public function logout(): void
    {
        $this->form->logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="fixed left-0 top-0 h-full w-64 bg-white border-r">
    <!-- Logo Section -->
    <div class="flex items-center justify-between p-[22.5px] border-b">
        <div class="flex items-center">
            <span class="ml-2 text-xl font-semibold">Sistema Ropa</span>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="p-4">
        <!-- Dashboard -->
        {{-- <div class="mb-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : '' }}">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="ml-2">Dashboard</span>
            </x-nav-link>
        </div> --}}

        <!-- Ventas Section -->
        <div class="mb-4">
            <h3 class="px-2 mb-2 text-xs font-semibold text-gray-600 uppercase">Ventas</h3>
            <div class="flex flex-col gap-1">
                <x-nav-link :href="route('dashboard.facturas')" :active="request()->routeIs('dashboard.facturas')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.facturas') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 14H13M9 17H15M9 11H13M17 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H12.5858C12.851 3 13.1054 3.10536 13.2929 3.29289L18.7071 8.70711C18.8946 8.89464 19 9.149 19 9.41421V19C19 20.1046 18.1046 21 17 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Facturas</span>
                </x-nav-link>

                <x-nav-link :href="route('dashboard.cartera')" :active="request()->routeIs('dashboard.cartera')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.cartera') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 10H21M7 15H8M12 15H13M6 19H18C19.1046 19 20 18.1046 20 17V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V17C4 18.1046 4.89543 19 6 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Cartera</span>
                </x-nav-link>
            </div>
        </div>

        <!-- Inventario Section -->
        <div class="mb-4">
            <h3 class="px-2 mb-2 text-xs font-semibold text-gray-600 uppercase">Inventario</h3>
            <div class="flex flex-col gap-1">
                <x-nav-link :href="route('dashboard.productos')" :active="request()->routeIs('dashboard.productos')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.productos') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 7L12 3L4 7M20 7L12 11M20 7V17L12 21M12 11L4 7M12 11V21M4 7V17L12 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Productos</span>
                </x-nav-link>
            </div>
        </div>

        <!-- Personas Section -->
        <div class="mb-4">
            <h3 class="px-2 mb-2 text-xs font-semibold text-gray-600 uppercase">Personas</h3>
            <div class="flex flex-col gap-1">
                <x-nav-link :href="route('dashboard.clientes')" :active="request()->routeIs('dashboard.clientes')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.clientes') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 20H22V18C22 16.3431 20.6569 15 19 15C18.0444 15 17.1931 15.4468 16.6438 16.1429M17 20H7M17 20V18C17 17.3438 16.8736 16.717 16.6438 16.1429M7 20H2V18C2 16.3431 3.34315 15 5 15C5.95561 15 6.80686 15.4468 7.35625 16.1429M7 20V18C7 17.3438 7.12642 16.717 7.35625 16.1429M7.35625 16.1429C8.0935 14.301 9.89482 13 12 13C14.1052 13 15.9065 14.301 16.6438 16.1429M15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7ZM21 10C21 11.1046 20.1046 12 19 12C17.8954 12 17 11.1046 17 10C17 8.89543 17.8954 8 19 8C20.1046 8 21 8.89543 21 10ZM7 10C7 11.1046 6.10457 12 5 12C3.89543 12 3 11.1046 3 10C3 8.89543 3.89543 8 5 8C6.10457 8 7 8.89543 7 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Clientes</span>
                </x-nav-link>

                <x-nav-link :href="route('dashboard.vendedores')" :active="request()->routeIs('dashboard.vendedores')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.vendedores') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Vendedores</span>
                </x-nav-link>

                @role('admin')
                <x-nav-link :href="route('dashboard.usuarios')" :active="request()->routeIs('dashboard.usuarios')" wire:navigate
                    class="flex items-center text-gray-700 hover:text-indigo-600 {{ request()->routeIs('dashboard.usuarios') ? 'text-indigo-600' : '' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-2">Usuarios</span>
                </x-nav-link>
                @endrole
            </div>
        </div>
    </div>

    <!-- User Menu -->
    <div class="absolute bottom-0 w-full border-t">
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-gray-300"></div>
                    <span class="ml-3 font-medium text-sm">{{ Auth::user()->name }}</span>
                </div>
                <button wire:click="logout" class="text-gray-500 hover:text-red-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 16L21 12M21 12L17 8M21 12H9M9 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

