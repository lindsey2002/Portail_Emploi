<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publier une offre d\'emploi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('offers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Titre du poste -->
                    <div>
                        <x-input-label for="title" value="Intitulé du poste" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Nom de l'entreprise -->
                    <div>
                        <x-input-label for="company_name" value="Nom de l'entreprise" />
                        <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>

                    <!-- Lieu et Type de contrat sur la même ligne -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="location" value="Lieu (ex: Dakar, Télétravail)" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="contract_type" value="Type de contrat" />
                            <select id="contract_type" name="contract_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Stage">Stage</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                            <x-input-error :messages="$errors->get('contract_type')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Salaire (Optionnel) -->
                    <div>
                        <x-input-label for="salary" value="Rémunération (Optionnel, ex: 45k - 50k)" />
                        <x-text-input id="salary" name="salary" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>

                    <!-- Description du poste -->
                    <div>
                        <x-input-label for="description" value="Description des missions et profil recherché" />
                        <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Annuler</a>
                        <x-primary-button>
                            {{ __('Publier l\'annonce') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>