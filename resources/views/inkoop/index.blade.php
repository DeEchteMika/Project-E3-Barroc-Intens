@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Producten (Inkoop beheer)</h1>

    <a href="{{ route('inkoop.create') }}" class="btn btn-primary">Nieuw product</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Productnummer</th>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Voorraad</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->product_id }}</td>
                <td>{{ $p->productnummer }}</td>
                <td>{{ $p->naam }}</td>
                <td>€ {{ number_format($p->prijs ?? 0,2,',','.') }}</td>
                <td>{{ $p->voorraad ?? 0 }}</td>
                <td>
                    <form action="{{ route('inkoop.destroy', $p->product_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Weet je het zeker?')">Verwijder</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

