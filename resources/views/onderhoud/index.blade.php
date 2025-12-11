@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold text-gray-900">Onderhoud</h1>
    <p class="mt-4 text-gray-600">Welkom bij de onderhoudsafdeling.</p>

    @if(auth()->user()->medewerker && auth()->user()->medewerker->functie === 'Monteur')
        <div class="mt-6">
            <a href="{{ route('storingen.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Mijn storingen bekijken
            </a>
        </div>
    @endif

    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <p class="text-gray-700">Voor meer informatie kunt u contact opnemen met de helpdesk.</p>
    </div>
</div>

@endsection
