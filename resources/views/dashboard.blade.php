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
                        @if(session()->has('success'))
                            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                                <p class="font-medium text-sm">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session()->has('error'))
                            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                                <p class="font-medium text-sm">{{ session('error') }}</p>
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
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Espace Candidat</h3>
                                <p class="text-sm text-gray-600 mb-8">Consultez les dernières opportunités disponibles et postulez en un clic.</p>
                                
                                <h4 class="text-md font-semibold text-gray-700 mb-4">Offres d'emploi disponibles ({{ $offers->count() }})</h4>

                                @if($offers->isEmpty())
                                    <div class="p-6 bg-gray-50 border rounded-lg text-center text-gray-500">
                                        Aucune offre d'emploi n'est disponible pour le moment.
                                    </div>
                                @else
                                    <div class="space-y-4">
                                        @foreach($offers as $offer)
                                            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                                <div class="space-y-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                        {{ $offer->contract_type }}
                                                    </span>
                                                    <h4 class="text-lg font-bold text-gray-900">{{ $offer->title }}</h4>
                                                    <p class="text-sm text-gray-600 font-medium">{{ $offer->company_name }} • {{ $offer->location }}</p>
                                                    @if($offer->salary)
                                                        <p class="text-xs text-gray-500 font-mono">Salaire : {{ $offer->salary }}</p>
                                                    @endif
                                                    <p class="text-sm text-gray-700 mt-2 line-clamp-2">{{ $offer->description }}</p>
                                                </div>
                                                <div class="w-full sm:w-auto text-right">
                                                    <a href="{{ route('applications.create', $offer->id) }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-gray-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 transition">
                                                        Postuler
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
