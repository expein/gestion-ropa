<div>
    <button wire:click="$set('showModal', true)" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-md font-semibold text-xs text-white tracking-widest transition ease-in-out duration-150">
        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Nuevo Usuario
    </button>

    <div x-data="{ show: @entangle('showModal') }" 
         x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 overflow-y-auto z-50" 
         style="display: none;"
         @click.away="show = false">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity" 
                 aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="show" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                 @click.away="show = false">
                <form wire:submit="save">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                    Crear Nuevo Usuario
                                </h3>

                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Nombre <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="name" wire:model.live="name" 
                                            class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                            @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                            @else border-gray-300 focus:border-indigo-500 @enderror"
                                            placeholder="Nombre completo">
                                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" id="email" wire:model.live="email" 
                                            class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                            @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                            @else border-gray-300 focus:border-indigo-500 @enderror"
                                            placeholder="correo@ejemplo.com">
                                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">
                                            Contraseña <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" id="password" wire:model.live="password" 
                                            class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                            @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                            @else border-gray-300 focus:border-indigo-500 @enderror"
                                            placeholder="Mínimo 8 caracteres">
                                        @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                            Confirmar Contraseña <span class="text-red-500">*</span>
                                        </label>
                                        <input type="password" id="password_confirmation" wire:model.live="password_confirmation" 
                                            class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                            @error('password_confirmation') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                            @else border-gray-300 focus:border-indigo-500 @enderror"
                                            placeholder="Repite la contraseña">
                                        @error('password_confirmation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="role" class="block text-sm font-medium text-gray-700">
                                            Rol <span class="text-red-500">*</span>
                                        </label>
                                        <select id="role" wire:model.live="role" 
                                            class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                            @error('role') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500
                                            @else border-gray-300 focus:border-indigo-500 @enderror">
                                            <option value="">Seleccione un rol</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>

                                    @if($role == 'vendedor')
                                        <div>
                                            <label for="tasa_comision" class="block text-sm font-medium text-gray-700">
                                                Tasa de Comisión (%) <span class="text-red-500">*</span>
                                            </label>
                                            <input type="number" step="0.01" id="tasa_comision" wire:model.live="tasa_comision" 
                                                class="mt-1 block w-full border rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 sm:text-sm
                                                @error('tasa_comision') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                                @else border-gray-300 focus:border-indigo-500 @enderror"
                                                placeholder="0.00">
                                            @error('tasa_comision') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Guardar
                        </button>
                        <button wire:click="$set('showModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 