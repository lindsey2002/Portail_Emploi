<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- GESTION DE L'ESPACE RECRUTEUR -->
                    @if(Auth::user()->role === 'recruiter')
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Espace Recruteur</h3>
                                <p class="text-sm text-gray-600">Gérez vos publications et examinez les profils reçus.</p>
                            </div>
                            <a href="{{ route('offers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition shadow-sm">
                                + Publier une offre
                            </a>
                        </div>

                        <h4 class="text-md font-semibold text-gray-700 mb-4">Vos annonces en ligne ({{ $myOffers->count() }})</h4>

                        @if($myOffers->isEmpty())
                            <div class="p-8 bg-gray-50 border border-gray-200 rounded-xl text-center text-gray-500">
                                Vous n'avez pas encore publié d'offre d'emploi.
                            </div>
                        @else
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            <th class="p-4">Poste</th>
                                            <th class="p-4">Entreprise</th>
                                            <th class="p-4">Lieu</th>
                                            <th class="p-4">Type</th>
                                            <th class="p-4 text-center">Candidatures</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-200">
                                        @foreach($myOffers as $myOffer)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4 font-semibold text-gray-900">{{ $myOffer->title }}</td>
                                                <td class="p-4 text-gray-600">{{ $myOffer->company_name }}</td>
                                                <td class="p-4 text-gray-500">{{ $myOffer->location }}</td>
                                                <td class="p-4">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $myOffer->contract_type }}
                                                    </span>
                                                </td>
                                                <td class="p-4 text-center">
                                                    @php
                                                        $count = \App\Models\Application::where('offer_id', $myOffer->id)->count();
                                                    @endphp
                                                    <a href="{{ route('offers.applications', $myOffer->id) }}" class="inline-flex items-center px-3 py-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-full transition">
                                                        Voir les CV ({{ $count }})
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    <!-- GESTION DE L'ESPACE CANDIDAT -->
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
</x-app-layout>