@props([
    'show' => false,
    'type' => 'success', // 'success', 'error', 'warning', 'info'
    'title' => '',
    'message' => '',
    'confirmText' => 'Aceptar',
    'cancelText' => null,
    'confirmAction' => null,
    'cancelAction' => null,
    'confirmButtonClass' => 'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500',
    'cancelButtonClass' => 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300 focus:ring-indigo-500',
    'closeAction' => null
])

@php
    $iconClasses = [
        'success' => 'h-12 w-12 text-green-600',
        'error' => 'h-12 w-12 text-red-600',
        'warning' => 'h-12 w-12 text-yellow-600',
        'info' => 'h-12 w-12 text-blue-600'
    ];
    
    $iconPaths = [
        'success' => 'M5 13l4 4L19 7',
        'error' => 'M6 18L18 6M6 6l12 12',
        'warning' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z',
        'info' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
    ];
    
    $bgClasses = [
        'success' => 'bg-green-100',
        'error' => 'bg-red-100',
        'warning' => 'bg-yellow-100',
        'info' => 'bg-blue-100'
    ];
@endphp

@if($show)
<div wire:ignore class="fixed inset-0 overflow-y-auto z-[9999] animate-fade-in">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity duration-300 ease-out animate-fade-in" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out animate-modal-in sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="text-center">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full mb-4 {{ $bgClasses[$type] }}">
                        <svg class="{{ $iconClasses[$type] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPaths[$type] }}" />
                        </svg>
                    </div>
                    <div class="mt-2">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">
                            {{ $title }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:justify-center {{ $cancelText ? 'sm:space-x-3' : '' }}">
                @if($confirmAction)
                    <button wire:click="{{ $confirmAction }}" type="button" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $confirmButtonClass }}">
                        {{ $confirmText }}
                    </button>
                @else
                    @if($closeAction)
                        <button wire:click="{{ $closeAction }}" type="button" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $confirmButtonClass }}">
                            {{ $confirmText }}
                        </button>
                    @else
                        <button type="button" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $confirmButtonClass }}">
                            {{ $confirmText }}
                        </button>
                    @endif
                @endif
                
                @if($cancelText)
                    @if($cancelAction)
                        <button wire:click="{{ $cancelAction }}" type="button" class="inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $cancelButtonClass }}">
                            {{ $cancelText }}
                        </button>
                    @else
                        @if($closeAction)
                            <button wire:click="{{ $closeAction }}" type="button" class="inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $cancelButtonClass }}">
                                {{ $cancelText }}
                            </button>
                        @else
                            <button type="button" class="inline-flex justify-center rounded-md border shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm {{ $cancelButtonClass }}">
                                {{ $cancelText }}
                            </button>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes modal-in {
    from {
        opacity: 0;
        transform: translateY(1rem) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-modal-in {
    animation: modal-in 0.3s ease-out;
}
</style>
@endif
