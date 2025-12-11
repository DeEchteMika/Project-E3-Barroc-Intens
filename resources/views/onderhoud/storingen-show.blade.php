@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Storing Details</h1>
        <a href="{{ route('storingen.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Terug naar lijst</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">{{ $storing->naam }}</h2>
            <p class="text-sm text-gray-600 mt-1">Storing ID: {{ $storing->storing_id }}</p>
        </div>

        <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Linker kolom -->
            <div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <div class="px-3 py-2 bg-gray-100 rounded">
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if($storing->status === 'open')
                                bg-red-100 text-red-800
                            @elseif($storing->status === 'in behandeling')
                                bg-yellow-100 text-yellow-800
                            @else
                                bg-green-100 text-green-800
                            @endif
                        ">
                            {{ ucfirst($storing->status) }}
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Klant</label>
                    <p class="text-gray-900">{{ $storing->klant->bedrijfsnaam ?? 'Onbekend' }}</p>
                    @if($storing->klant)
                        <p class="text-sm text-gray-600">{{ $storing->klant->contactpersoon ?? '' }}</p>
                        <p class="text-sm text-gray-600">{{ $storing->klant->telefoonnummer ?? '' }}</p>
                    @endif
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Monteur</label>
                    <p class="text-gray-900">
                        {{ optional($storing->monteur)->voornaam ? $storing->monteur->voornaam . ' ' . $storing->monteur->achternaam : 'Nog niet toegewezen' }}
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Datum Gemeld</label>
                    <p class="text-gray-900">
                        {{ $storing->datum ? \Carbon\Carbon::parse($storing->datum)->format('d-m-Y H:i') : 'Niet ingesteld' }}
                    </p>
                </div>
            </div>

            <!-- Rechter kolom -->
            <div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Locatie</label>
                    <p class="text-gray-900">{{ $storing->locatie ?? '-' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bedrijf</label>
                    <p class="text-gray-900">{{ $storing->bedrijf ?? '-' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Aangemaakt</label>
                    <p class="text-gray-900">
                        {{ $storing->created_at->format('d-m-Y H:i') }}
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Laatst Bijgewerkt</label>
                    <p class="text-gray-900">
                        {{ $storing->updated_at->format('d-m-Y H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Beschrijving -->
        <div class="px-6 py-6 border-t border-gray-200">
            <label class="block text-sm font-medium text-gray-700 mb-2">Beschrijving</label>
            <div class="bg-gray-50 px-4 py-3 rounded">
                <p class="text-gray-900">{{ $storing->beschrijving ?? 'Geen beschrijving' }}</p>
            </div>
        </div>

        <!-- Acties -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-3">
            <a href="{{ route('storingen.edit', $storing->storing_id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Wijzig monteur/status
            </a>
            <a href="{{ route('storingen.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Terug
            </a>
        </div>
    </div>
</div>
@endsection
