@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold text-gray-900">Klantenservice</h1>
    <p class="mt-4 text-gray-600">Welkom bij de klantenservice. Plaats hier je contactinformatie, FAQ of formulieren.</p>

    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <p class="text-gray-700">meld een nieuw storing</p>
        <div class="mt-4">
            <a href="{{ route('storingen.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Nieuwe Storing</a>
        </div>
    </div>
</div>

@endsection
