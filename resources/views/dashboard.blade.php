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

                <!-- INJECTION DU NOUVEAU TABLEAU DE SUIVI DES CANDIDATURES REÇUES -->
                    <div class="mt-12 border-t pt-8">
    <h3 class="text-xl font-bold text-gray-900 mb-2">Gestion des candidatures reçues</h3>
    <p class="text-sm text-gray-600 mb-6">Consultez et modifiez le statut des candidats qui ont postulé à vos offres.</p>

    @if(isset($recruiterApplications) && !$recruiterApplications->isEmpty())
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Candidat</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Poste visé</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Score Matching</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recruiterApplications as $application)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $application->user->name }} <br>
                                <span class="text-xs text-gray-500">{{ $application->user->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                {{ $application->offer->title ?? 'Offre indisponible' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $application->match_score >= 70 ? 'bg-green-100 text-green-800' : ($application->match_score >= 40 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $application->match_score }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <!-- Bouton Accepter (Devient Bleu si déjà accepté) -->
                                <form action="{{ route('applications.update-status', [$application->id, 'accepte']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-block px-4 py-2 text-xs font-bold uppercase rounded-md shadow-md transition cursor-pointer select-none {{ $application->status === 'accepte' ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-blue-600 hover:text-white text-gray-700' }}">
                                        Accepter
                                    </button>
                                </form>

                                <!-- Bouton Refuser (Devient Rouge si déjà refusé) -->
                                <form action="{{ route('applications.update-status', [$application->id, 'refuse']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-block px-4 py-2 text-xs font-bold uppercase rounded-md shadow-md transition cursor-pointer select-none {{ $application->status === 'refuse' ? 'bg-rose-600 text-white' : 'bg-gray-200 hover:bg-rose-600 hover:text-white text-gray-700' }}">
                                        Refuser
                                    </button>
                                </form>
                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Retirer définitivement ce candidat de la liste ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color: #dc3545; background: none; border: none; padding: 0; cursor: pointer;">
                                        ❌ Retirer la candidature
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-6 bg-gray-50 border rounded-lg text-center text-gray-500">
            Aucune candidature n'a encore été déposée pour vos offres.
        </div>
    @endif
</div>    
                    <!-- GESTION DE L'ESPACE CANDIDAT -->
                    @else
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Espace Candidat</h3>
                            <p class="text-sm text-gray-600 mb-8">Consultez les dernières opportunités disponibles et postulez en un clic.</p>
                            
                            <h4 class="text-md font-semibold text-gray-700 mb-4">Vos candidatures envoyées ({{ $applications->count() }})</h4>

                                @if($applications->isEmpty())
                                    <div class="p-6 bg-gray-50 border rounded-lg text-center text-gray-500 mb-8">
                                        Vous n'avez pas encore postulé à une offre.
                                    </div>
                                @else
                                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-8">
                                        <table class="w-full text-left border-collapse">
                                            <thead>
                                                <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    <th class="p-4">Poste</th>
                                                    <th class="p-4">Entreprise</th>
                                                    <th class="p-4">Score Matching</th>
                                                    <th class="p-4">Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm divide-y divide-gray-200">
                                                @foreach($applications as $application)
                                                    <tr class="hover:bg-gray-50 transition">
                                                        <td class="p-4 font-semibold text-gray-900">{{ $application->offer->title ?? 'Poste supprimé' }}</td>
                                                        <td class="p-4 text-gray-600">{{ $application->offer->company_name ?? '-' }}</td>
                                                        <td class="p-4">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $application->match_score >= 70 ? 'bg-green-100 text-green-800' : ($application->match_score >= 40 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                                {{ $application->match_score }}%
                                                            </span>
                                                        </td>
                                                        <td class="p-4">
                                                            @if($application->status === 'accepte')
                                                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-emerald-100 text-emerald-800 uppercase">Accepté</span>
                                                            @elseif($application->status === 'refuse')
                                                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-rose-100 text-rose-800 uppercase">Refusé</span>
                                                            @else
                                                                <span class="px-2 py-0.5 text-xs font-bold rounded bg-amber-100 text-amber-800 uppercase">En cours</span>
                                                            @endif
                                                        </td>
                                                        <td class="p-4">
                                                            @if($application->status === 'en cours')
                                                                <!-- Le candidat peut annuler s'il n'y a pas encore de réponse -->
                                                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Annuler définitivement ta candidature pour ce poste ?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" style="color: #dc3545; background: none; border: none; cursor: pointer;" class="hover:underline">
                                                                        ❌ Annuler ma candidature
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <!-- Si c'est accepté ou refusé, il peut juste nettoyer son historique -->
                                                                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Masquer cette candidature de ton historique ?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" style="color: #6c757d; background: none; border: none; cursor: pointer;" class="hover:underline">
                                                                        🗑️ Retirer de l'historique
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                <hr class="my-8 border-gray-200">

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