@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('onderhoud.dashboard') }}" class="text-blue-600 hover:text-blue-900 text-sm">
            ← Terug naar dashboard
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Alle Klanten met Onderhoud</h1>
        <p class="text-gray-600 mt-2">Volledige lijst van onderhoudswerkzaamheden per klant</p>
    </div>

    @if ($maintenance->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach ($maintenance->groupBy('klant_id') as $klantMaintenance)
                @php
                    $klant = $klantMaintenance->first()->klant;
                    $dueCount = $klantMaintenance->where('volgende_onderhoud', '<=', \Carbon\Carbon::now()->addDays(3))
                        ->where('volgende_onderhoud', '>', \Carbon\Carbon::now())->count();
                    $overdueCount = $klantMaintenance->where('volgende_onderhoud', '<', \Carbon\Carbon::now())->count();
                @endphp
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
                        <h2 class="text-xl font-bold text-white">{{ $klant->bedrijfsnaam }}</h2>
                        <p class="text-blue-100">{{ $klant->contactpersoon }}</p>
                        <p class="text-blue-100">{{ $klant->telefoon }} • {{ $klant->email }}</p>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between">
                        @if ($dueCount > 0)
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">
                                {{ $dueCount }} binnenkort
                            </span>
                        @endif
                        @if ($overdueCount > 0)
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                                {{ $overdueCount }} achterstallig
                            </span>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200 bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Contract</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Interval</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Volgende Onderhoud</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($klantMaintenance as $m)
                                    @php
                                        $isOverdue = $m->isOverdue();
                                        $isDueSoon = $m->isDueSoon();
                                    @endphp
                                    <tr class="border-b border-gray-200 {{ $isOverdue ? 'bg-red-50' : ($isDueSoon ? 'bg-orange-50' : '') }}">
                                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                            {{ $m->contract->contractnummer }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">
                                                {{ $m->interval_label }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $m->volgende_onderhoud->format('d-m-Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @if ($isOverdue)
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded font-semibold">
                                                    🔴 Achterstallig
                                                </span>
                                            @elseif ($isDueSoon)
                                                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded font-semibold">
                                                    🟠 Binnenkort
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded font-semibold">
                                                    ✅ Op schema
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium space-x-2">
                                            <form method="POST" action="{{ route('onderhoud.complete', $m->onderhoud_schema_id) }}" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 underline">
                                                    Voltooid
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <p class="text-gray-500 text-lg">Geen onderhoudswerkzaamheden gepland</p>
        </div>
    @endif
</div>
@endsection
