@section('title', 'Vendedores')

<div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 lg:p-8">
                    <!-- Header con título y botón de crear -->
                    <div class="sm:flex sm:items-center sm:justify-between mb-6">
                        <div class="sm:flex-auto">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Listado de Vendedores</h3>
                            <p class="mt-2 text-sm text-gray-700">Gestiona los vendedores del sistema</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <livewire:dashboard.vendedores.create />
                        </div>
                    </div>

                    @if($vendedores->isEmpty())
                        <!-- Mensaje cuando no hay vendedores -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay vendedores</h3>
                            <p class="mt-1 text-sm text-gray-500">Comienza agregando un nuevo vendedor al sistema.</p>
                            <div class="mt-6">
                                <livewire:dashboard.vendedores.create />
                            </div>
                        </div>
                    @else
                        <!-- Barra de búsqueda y filtros -->
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                            <div class="w-full sm:w-64 mb-4 sm:mb-0">
                                <label for="search" class="sr-only">Buscar</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input wire:model.live="search" type="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar vendedores...">
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <select wire:model.live="perPage" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="10">10 por página</option>
                                    <option value="25">25 por página</option>
                                    <option value="50">50 por página</option>
                                    <option value="100">100 por página</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tabla de vendedores -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Usuario
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tasa de Comisión
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Comisión Total
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($vendedores as $vendedor)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $vendedor->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $vendedor->tasa_comision }}%
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($vendedor->comision_total, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" class="text-indigo-600 hover:text-indigo-900">
                                                        Editar
                                                    </button>
                                                    <button type="button" class="text-red-600 hover:text-red-900">
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $vendedores->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
