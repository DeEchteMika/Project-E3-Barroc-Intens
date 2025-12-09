@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Storing bijwerken</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('storingen.update', $storing->storing_id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Storing</label>
                <p class="mt-1 text-gray-800">{{ $storing->naam }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ $storing->beschrijving }}</p>
            </div>

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

            <div class="flex items-center justify-between">
                <a href="{{ route('storingen.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Terug naar overzicht</a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">Opslaan</button>
            </div>
        </form>
    </div>
</div>
@endsection
