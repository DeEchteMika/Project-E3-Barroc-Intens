@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Producten</h1>
        <a href="{{ route('inkoop.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-gray-900 text-sm font-medium rounded-md hover:bg-blue-700">Nieuw product</a>
        <a href="{{ route('inkoop.orders') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-gray-900 text-sm font-medium rounded-md hover:bg-green-700">Bekijk bestellingen</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productnummer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prijs</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Voorraad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $p)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $p->product_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $p->productnummer }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $p->naam }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">€ {{ number_format($p->prijs ?? 0,2,',','.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $p->voorraad ?? 0 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">

                        <a href="{{ route('inkoop.show', $p) }}" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Bekijken</a>
                        <a href="{{ route('inkoop.edit', $p) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Bewerken</a>
                        <form action="{{ route('inkoop.destroy', $p) }}" method="POST" onsubmit="return confirm('Weet je het zeker?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Verwijderen</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
    <script>
        (function(){
            var msg = {!! json_encode(session('success')) !!};
            alert(msg);
        })();
    </script>
@endif

@endsection

