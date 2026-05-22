<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700 text-sm">&larr; Retour</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Candidatures pour : {{ $offer->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 p-4 bg-gray-100 rounded-lg text-sm text-gray-600">
                <strong>Rappel :</strong> Offre publiée pour <strong>{{ $offer->company_name }}</strong> à <strong>{{ $offer->location }}</strong>.
            </div>

            @if($applications->isEmpty())
                <div class="bg-white p-8 border border-gray-200 rounded-xl text-center text-gray-500 shadow-sm">
                    Aucun candidat n'a encore postulé à cette offre.
                </div>
            @else
                <div class="space-y-6">
                    @foreach($applications as $application)
                        <div class="bg-white p-6 border border-gray-200 rounded-xl shadow-sm space-y-4">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-100 pb-3">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $application->user->name }}</h3>
                                    <div class="mt-1 flex items-center space-x-2">
                                        <span class="text-xs font-semibold text-gray-500">Compatibilité IA Profile :</span>
                                        @if($application->match_score >= 70)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">
                                                {{ $application->match_score }}% (Profil Idéal)
                                            </span>
                                        @elseif($application->match_score >= 40)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-yellow-100 text-yellow-800">
                                                {{ $application->match_score }}% (Profil Moyen)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-red-100 text-red-800">
                                                {{ $application->match_score }}% (Faible correspondance)
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500">Contact : {{ $application->user->email }} • Postulé le {{ $application->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                                
                                <!-- Bouton magique d'ouverture du CV PDF -->
                                <div class="mt-2 sm:mt-0">
                                    <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg uppercase tracking-wider transition shadow-sm">
                                        📄 Ouvrir le CV (PDF)
                                    </a>
                                </div>
                            </div>

                            @if($application->cover_letter)
                                <div>
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Message / Lettre de motivation :</h4>
                                    <p class="text-sm text-gray-700 bg-gray-50 p-4 rounded-lg italic whitespace-pre-line">
                                        "{{ $application->cover_letter }}"
                                    </p>
                                </div>
                            @else
                                <p class="text-xs text-gray-400 italic">Le candidat n'a pas laissé de message d'accompagnement.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>