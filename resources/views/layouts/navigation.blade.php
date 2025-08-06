                    <x-nav-link :href="route('dashboard.vendedores')" :active="request()->routeIs('dashboard.vendedores')">
                        {{ __('Vendedores') }}
                    </x-nav-link>

                    @role('admin')
                    <x-nav-link :href="route('dashboard.usuarios')" :active="request()->routeIs('dashboard.usuarios')">
                        {{ __('Usuarios') }}
                    </x-nav-link>
                    @endrole 