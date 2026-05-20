<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900">
                        @if(session('success'))
                            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(Auth::user()->role === 'recruiter')
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-bold">Espace Recruteur</h3>
                                    <p class="text-sm text-gray-600">Bienvenue, gérez vos offres d'emploi depuis cet espace.</p>
                                </div>
                                <a href="{{ route('offers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dynamic-transition">
                                    + Publier une offre
                                </a>
                            </div>
                        @else
                            <div>
                                <h3 class="text-lg font-bold">Espace Candidat</h3>
                                <p class="text-sm text-gray-600">Bienvenue, consultez les offres disponibles et postulez en ligne.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
