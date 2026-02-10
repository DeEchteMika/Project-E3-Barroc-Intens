@extends('layouts.app')

@section('content')
	<div class="max-w-3xl mx-auto py-16 text-center">
		<h1 class="text-3xl md:text-4xl">Welkom bij {{ config('app.name') }}</h1>
		<p class="mt-4 text-gray-600">Beheer je projecten en onderhoudsgegevens.</p>
	</div>
@endsection
