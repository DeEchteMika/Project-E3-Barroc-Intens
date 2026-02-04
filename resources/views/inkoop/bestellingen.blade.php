@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Bestellingen</h1>
        <a href="{{ route('inkoop.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-gray-900 text-sm font-medium rounded-md hover:bg-blue-700">Terug naar producten</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bestelling ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productnaam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aantal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medewerker</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Totaal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($bestellingen as $b)
                    @foreach($b->regels as $r)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $b->inkoop_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ optional($r->product)->naam }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $r->aantal }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ optional($b->medewerker)->voornaam }} {{ optional($b->medewerker)->achternaam }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">€ {{ number_format($b->totaalbedrag ?? 0,2,',','.') }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
