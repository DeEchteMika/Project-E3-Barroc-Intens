@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inkoop #{{ $inkoop->inkoop_id }}</h1>
    <p>Datum: {{ $inkoop->datum }}</p>
    <p>Medewerker: {{ optional($inkoop->medewerker)->voornaam ?? '-' }}</p>
    <p>Totaal: € {{ number_format($inkoop->totaalbedrag ?? 0,2,',','.') }}</p>

    <h4>Productregels</h4>
    <table class="table">
        <thead><tr><th>Product</th><th>Aantal</th><th>Prijs p/st</th><th>Subtotaal</th><th>Acties</th></tr></thead>
        <tbody>
            @foreach($inkoop->regels as $regel)
            <tr>
                <td>{{ optional($regel->product)->naam ?? '-' }}</td>
                <td>{{ $regel->aantal }}</td>
                <td>€ {{ number_format($regel->prijs_per_stuk ?? 0,2,',','.') }}</td>
                <td>€ {{ number_format($regel->subtotaal ?? 0,2,',','.') }}</td>
                <td>
                    <form action="{{ route('inkoop.regel.destroy', ['inkoop' => $inkoop->inkoop_id, 'regel' => $regel->inkoopregel_id ?? $regel->id]) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Verwijder regel?')">Verwijder</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Product toevoegen</h4>
    <form action="{{ route('inkoop.regel.store', $inkoop->inkoop_id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <select name="product_id" class="form-control">
                    @foreach($products as $p)
                        <option value="{{ $p->product_id }}">{{ $p->naam }} ({{ $p->productnummer }}) - €{{ number_format($p->prijs ?? 0,2,',','.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="aantal" value="1" min="1" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Voeg toe</button>
            </div>
        </div>
    </form>

    <p class="mt-3"><a href="{{ route('inkoop.index') }}">Terug naar overzicht</a></p>
</div>
@endsection
