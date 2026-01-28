@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Storing bijwerken & werkzaamheden</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('storingen.update', $storing->storing_id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Storing</label>
                <p class="mt-1 text-gray-800 font-semibold">{{ $storing->naam }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ $storing->beschrijving }}</p>
            </div>

            <hr>
            <h3 class="text-lg font-semibold text-gray-900">Toewijzing & Status</h3>

            <div>
                <label for="monteur_id" class="block text-sm font-medium text-gray-700">Monteur</label>
                <select id="monteur_id" name="monteur_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Geen monteur (nog niet toegewezen)</option>
                    @foreach($monteurs as $monteur)
                        <option value="{{ $monteur->medewerker_id }}" @selected(old('monteur_id', $storing->monteur_id) == $monteur->medewerker_id)>
                            {{ $monteur->voornaam }} {{ $monteur->achternaam }}
                        </option>
                    @endforeach
                </select>
                @error('monteur_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach(['open' => 'Open', 'in behandeling' => 'In behandeling', 'opgelost' => 'Opgelost'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $storing->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr>
            <h3 class="text-lg font-semibold text-gray-900">Onderhouds Werkzaamheden</h3>

            <div>
                <label for="storingscode" class="block text-sm font-medium text-gray-700">Storingscode</label>
                <input type="text" id="storingscode" name="storingscode" maxlength="50" value="{{ old('storingscode', $storing->onderhoudswerk->storingscode ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('storingscode')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="opmerkingen" class="block text-sm font-medium text-gray-700">Opmerkingen</label>
                <textarea id="opmerkingen" name="opmerkingen" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('opmerkingen', $storing->onderhoudswerk->opmerkingen ?? '') }}</textarea>
                @error('opmerkingen')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="checklist_voltooid" class="flex items-center">
                        <input type="checkbox" id="checklist_voltooid" name="checklist_voltooid" value="1" @checked(old('checklist_voltooid', $storing->onderhoudswerk->checklist_voltooid ?? false))>
                        <span class="ml-2 text-sm font-medium text-gray-700">Checklist voltooid</span>
                    </label>
                </div>
                <div>
                    <label for="storing_verholpen" class="flex items-center">
                        <input type="checkbox" id="storing_verholpen" name="storing_verholpen" value="1" @checked(old('storing_verholpen', $storing->onderhoudswerk->storing_verholpen ?? false))>
                        <span class="ml-2 text-sm font-medium text-gray-700">Storing verholpen</span>
                    </label>
                </div>
                <div>
                    <label for="goedgekeurd" class="flex items-center">
                        <input type="checkbox" id="goedgekeurd" name="goedgekeurd" value="1" @checked(old('goedgekeurd', $storing->onderhoudswerk->goedgekeurd ?? false))>
                        <span class="ml-2 text-sm font-medium text-gray-700">Goedgekeurd</span>
                    </label>
                </div>
            </div>

            <div>
                <label for="handtekening_url" class="block text-sm font-medium text-gray-700">Handtekeningafbeelding URL</label>
                <input type="text" id="handtekening_url" name="handtekening_url" value="{{ old('handtekening_url', $storing->onderhoudswerk->handtekening_url ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('handtekening_url')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('storingen.show', $storing->storing_id) }}" class="text-sm text-gray-600 hover:text-gray-900">Terug naar detail</a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">Opslaan</button>
            </div>
        </form>
    </div>
</div>
@endsection

