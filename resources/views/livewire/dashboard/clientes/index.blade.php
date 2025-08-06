@section('title', 'Clientes')

<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            <div class="p-6 lg:p-8">
                <!-- Header con título y subtítulo -->
                <div class="sm:flex sm:items-center sm:justify-between mb-6">
                    <div class="sm:flex-auto">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Listado de Clientes</h3>
                        <p class="mt-2 text-sm text-gray-700">Gestiona los clientes del sistema</p>
                    </div>
                    @if(!$clientes->isEmpty())
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <livewire:dashboard.clientes.create />
                    </div>
                    @endif
                </div>

                @if($clientes->isEmpty())
                    <!-- Estado vacío con ícono y mensaje -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay clientes</h3>
                        <p class="mt-1 text-sm text-gray-500">Comienza agregando un nuevo cliente al sistema.</p>
                        <div class="mt-6">
                            <livewire:dashboard.clientes.create />
                        </div>
                    </div>
                @else
                    <!-- Barra de búsqueda y filtros -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                        <div class="w-full sm:w-64 mb-4 sm:mb-0">
                            <label for="search" class="sr-only">Buscar</label>
                            <div class="relative">
                                <input wire:model.live="search" type="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar clientes...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
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

                    <!-- Tabla de clientes -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach(['nombre' => 'Nombre', 'tipo_documento' => 'Tipo Doc.', 'numero_documento' => 'Número Doc.', 'email' => 'Email', 'telefono' => 'Teléfono'] as $field => $label)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('{{ $field }}')">
                                            <div class="flex items-center space-x-1">
                                                <span>{{ $label }}</span>
                                                @if($sortField === $field)
                                                    <span>
                                                        @if($sortDirection === 'asc')
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                                        @else
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </th>
                                    @endforeach
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $cliente->nombre }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->tipo_documento }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->numero_documento }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->telefono }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <button class="text-indigo-600 hover:text-indigo-900">
                                                    Editar
                                                </button>
                                                <button class="text-red-600 hover:text-red-900">
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
                        {{ $clientes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
