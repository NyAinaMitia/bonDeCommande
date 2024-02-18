<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" style="position: sticky;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('bdc.welcome') }}">
                        <img src="{{ asset('images/agl_bleu.svg') }}" alt="Logo AGL" style="width:80px;height:80px">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('bdc.welcome')" :active="request()->routeIs('bdc.welcome')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        {{ __('Utilisateurs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('fournisseurs.index')" :active="request()->routeIs('fournisseurs.index')">
                        {{ __('Fournisseurs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('produits.index')" :active="request()->routeIs('produits.index')">
                        {{ __('Produits') }}
                    </x-nav-link>
                    <x-nav-link :href="route('bdc.create')" :active="request()->routeIs('bdc.create')">
                        {{ __('Effectuer un bon de Commande') }}
                    </x-nav-link>
                    <x-nav-link :href="route('bdc.create')" :active="request()->routeIs('bdc.create')">
                        {{ __('Se déconnecter') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

</nav>
