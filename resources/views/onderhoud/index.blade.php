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
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Onderhouds Dashboard</h1>
            <p class="text-gray-600 mt-2">Beheer en monitor alle geplande onderhoudswerkzaamheden</p>
        </div>
        <a href="{{ route('onderhoud.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
            + Nieuw Onderhoudschema
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Totaal Vervallen</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $summary['total_due'] }}</p>
                </div>
                <div class="text-4xl text-yellow-500">⚠️</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Binnenkort Vervallen (3 dagen)</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">{{ $summary['due_soon_count'] }}</p>
                </div>
                <div class="text-4xl text-orange-500">📅</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Achterstallig</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $summary['overdue_count'] }}</p>
                </div>
                <div class="text-4xl text-red-500">🔴</div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200">
            <nav class="flex" aria-label="Tabs">
                <a href="#" class="px-6 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600 cursor-pointer"
                    onclick="showTab(event, 'dueSoon')">
                    Binnenkort Vervallen
                </a>
                <a href="#" class="px-6 py-3 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-gray-900 cursor-pointer"
                    onclick="showTab(event, 'overdue')">
                    Achterstallig
                </a>
                <a href="#" class="px-6 py-3 text-sm font-medium text-gray-600 border-b-2 border-transparent hover:text-gray-900 cursor-pointer"
                    onclick="showTab(event, 'allMaintenance')">
                    Alle onderhoud
                </a>
            </nav>
        </div>

        <!-- Due Soon Tab -->
        <div id="dueSoon" class="p-6">
            @if ($dueSoon->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contract</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interval</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volgende Onderhoud</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uren Resterend</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($dueSoon as $maintenance)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $maintenance->klant->bedrijfsnaam }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $maintenance->klant->contactpersoon }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ optional($maintenance->contract)->contractnummer ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $maintenance->interval_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $maintenance->volgende_onderhoud->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            {{ $maintenance->daysUntilMaintenance() }} uren
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($maintenance->monteur)
                                            <div class="flex items-center">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">
                                                    {{ $maintenance->monteur->voornaam }} {{ $maintenance->monteur->achternaam }}
                                                </span>
                                            </div>
                                        @else
                                            <form method="POST" action="{{ route('onderhoud.assignMonteur', $maintenance->onderhoud_schema_id) }}" class="flex items-center space-x-2">
                                                @csrf
                                                <select name="monteur_id" required class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Selecteer monteur</option>
                                                    @foreach($monteurs as $monteur)
                                                        <option value="{{ $monteur->medewerker_id }}">
                                                            {{ $monteur->voornaam }} {{ $monteur->achternaam }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium">
                                                    Toewijzen
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <form method="POST" action="{{ route('onderhoud.complete', $maintenance->onderhoud_schema_id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                Voltooid
                                            </button>
                                        </form>
                                        <a href="{{ route('onderhoud.deactivate', $maintenance->onderhoud_schema_id) }}"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Weet u zeker dat u dit onderhoudschema wilt deactiveren?')">
                                            Deactiveer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Geen onderhoud gepland voor de komende 3 dagen</p>
                </div>
            @endif
        </div>

        <!-- Overdue Tab -->
        <div id="overdue" class="p-6 hidden">
            @if ($overdue->count() > 0)
                <div class="bg-red-50 border border-red-200 rounded p-4 mb-6">
                    <p class="text-red-800 font-semibold">
                        ⚠️ Er zijn {{ $overdue->count() }} achterstallige onderhoudswerkzaamheden. Neem onmiddellijk contact op met de klanten!
                    </p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contract</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interval</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vervaldatum</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dagen Achterstand</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monteur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($overdue as $maintenance)
                                <tr class="hover:bg-gray-50 bg-red-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $maintenance->klant->bedrijfsnaam }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $maintenance->klant->contactpersoon }}<br>
                                            {{ $maintenance->klant->telefoon }} | {{ $maintenance->klant->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ optional($maintenance->contract)->contractnummer ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $maintenance->interval_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $maintenance->volgende_onderhoud->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ abs($maintenance->daysUntilMaintenance()) }} dagen
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($maintenance->monteur)
                                            <div class="flex items-center">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">
                                                    {{ $maintenance->monteur->voornaam }} {{ $maintenance->monteur->achternaam }}
                                                </span>
                                            </div>
                                        @else
                                            <form method="POST" action="{{ route('onderhoud.assignMonteur', $maintenance->onderhoud_schema_id) }}" class="flex items-center space-x-2">
                                                @csrf
                                                <select name="monteur_id" required class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Selecteer monteur</option>
                                                    @foreach($monteurs as $monteur)
                                                        <option value="{{ $monteur->medewerker_id }}">
                                                            {{ $monteur->voornaam }} {{ $monteur->achternaam }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium">
                                                    Toewijzen
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <form method="POST" action="{{ route('onderhoud.complete', $maintenance->onderhoud_schema_id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                Voltooid
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Geen achterstallige onderhoudswerkzaamheden 🎉</p>
                </div>
            @endif
        </div>

        <!-- All Maintenance Tab -->
        <div id="allMaintenance" class="p-6 hidden">
            @if ($allMaintenance->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contract</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interval</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volgende Onderhoud</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monteur</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allMaintenance as $maintenance)
                                @php
                                    $isOverdue = $maintenance->isOverdue();
                                    $isDueSoon = $maintenance->isDueSoon();
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $maintenance->klant->bedrijfsnaam }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $maintenance->klant->contactpersoon }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ optional($maintenance->contract)->contractnummer ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $maintenance->interval_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $maintenance->volgende_onderhoud->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($isOverdue)
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Achterstallig
                                            </span>
                                        @elseif ($isDueSoon)
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                Binnenkort
                                            </span>
                                        @else
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Op schema
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($maintenance->monteur)
                                            <div class="flex items-center">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">
                                                    {{ $maintenance->monteur->voornaam }} {{ $maintenance->monteur->achternaam }}
                                                </span>
                                            </div>
                                        @else
                                            <form method="POST" action="{{ route('onderhoud.assignMonteur', $maintenance->onderhoud_schema_id) }}" class="flex items-center space-x-2">
                                                @csrf
                                                <select name="monteur_id" required class="text-sm border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    <option value="">Selecteer monteur</option>
                                                    @foreach($monteurs as $monteur)
                                                        <option value="{{ $monteur->medewerker_id }}">
                                                            {{ $monteur->voornaam }} {{ $monteur->achternaam }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium">
                                                    Toewijzen
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Geen onderhoudschema's gevonden</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function showTab(event, tabName) {
    event.preventDefault();

    // Hide all tabs
    document.getElementById('dueSoon').classList.add('hidden');
    document.getElementById('overdue').classList.add('hidden');
    document.getElementById('allMaintenance').classList.add('hidden');

    // Show selected tab
    document.getElementById(tabName).classList.remove('hidden');

    // Update tab styling
    document.querySelectorAll('nav a').forEach(link => {
        link.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
        link.classList.add('text-gray-600', 'border-transparent');
    });

    event.target.classList.remove('text-gray-600', 'border-transparent');
    event.target.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
}
</script>
    </div>
</div>

@endsection
