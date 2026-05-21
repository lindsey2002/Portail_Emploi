<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer votre candidature') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <!-- Rappel de l'offre en haut -->
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-indigo-600">{{ $offer->title }}</h3>
                    <p class="text-sm text-gray-600 font-medium">{{ $offer->company_name }} — {{ $offer->location }} ({{ $offer->contract_type }})</p>
                </div>

                <!-- Formulaire de postulation -->
                <form action="{{ route('applications.store', $offer->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Lettre de motivation / Message -->
                    <div>
                        <x-input-label for="cover_letter" value="Lettre de motivation ou message au recruteur (Optionnel)" />
                        <textarea id="cover_letter" name="cover_letter" rows="5" placeholder="Expliquez brièvement pourquoi vous postulez à cette offre..." class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('cover_letter')" class="mt-2" />
                    </div>

                    <!-- Téléchargement du CV -->
                    <div>
                        <x-input-label for="resume" value="Votre Curriculum Vitae (Format PDF uniquement, max 2Mo)" />
                        <input id="resume" name="resume" type="file" accept=".pdf" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" required />
                        <x-input-error :messages="$errors->get('resume')" class="mt-2" />
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Annuler</a>
                        <x-primary-button>
                            {{ __('Envoyer ma candidature') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>