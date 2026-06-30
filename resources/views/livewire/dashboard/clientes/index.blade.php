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

                <!-- Alertas de éxito y error -->
                @if (session()->has('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

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
                                    @foreach(['nombre' => 'Nombre', 'numero_documento' => 'Documento', 'telefono' => 'Teléfono', 'direccion' => 'Dirección', 'zona' => 'Zona'] as $field => $label)
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
                                            {{ $cliente->tipo_documento }} {{ $cliente->numero_documento }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->telefono ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->direccion ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cliente->zona ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <button class="text-indigo-600 hover:text-indigo-900 p-1 rounded-full hover:bg-indigo-50" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <button wire:click="confirmDelete({{ $cliente->id }})" type="button" class="text-red-600 hover:text-red-900 p-1 rounded-full hover:bg-red-50" title="Eliminar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
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

    <!-- Modal de Confirmación de Eliminación -->
    <x-alert-modal 
        :show="$showConfirmModal"
        type="warning"
        title="Confirmar Eliminación"
        message="¿Está seguro de que desea eliminar este cliente? Esta acción no se puede deshacer."
        confirmText="Eliminar"
        cancelText="Cancelar"
        confirmAction="delete"
        closeAction="closeConfirmModal"
        :confirmButtonClass="'bg-red-600 hover:bg-red-700 focus:ring-red-500'"
    />

    <!-- Modal de Éxito -->
    <x-alert-modal 
        :show="$showSuccessModal"
        type="success"
        title="Éxito"
        message="Cliente eliminado exitosamente."
        confirmText="Aceptar"
        closeAction="closeSuccessModal"
    />
</div>
