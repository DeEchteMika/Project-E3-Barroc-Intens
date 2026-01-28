@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Top stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            {{ __('Today\'s Revenue') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            € 4.250,–
                        </p>
                        <p class="mt-1 text-xs text-emerald-600">
                            +18% {{ __('vs. yesterday') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            {{ __('Open Quotes') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            12
                        </p>
                        <p class="mt-1 text-xs text-amber-600">
                            {{ __('Follow-up needed within 3 days') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            {{ __('Active Customers') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            37
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ __('Last 30 days') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            {{ __('Conversion Rate') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900">
                            32%
                        </p>
                        <p class="mt-1 text-xs text-emerald-600">
                            {{ __('Improved this week') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Main content: left = pipeline, right = quick actions + top customers --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Sales pipeline --}}
                <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg">
                    <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ __('Sales Pipeline') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('Overview of current opportunities and their status.') }}
                        </p>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-3 py-2">{{ __('Customer') }}</th>
                                <th class="px-3 py-2">{{ __('Project') }}</th>
                                <th class="px-3 py-2">{{ __('Stage') }}</th>
                                <th class="px-3 py-2 text-right">{{ __('Value') }}</th>
                                <th class="px-3 py-2 text-right">{{ __('Expected Close') }}</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-3 py-3 text-gray-900">
                                    Barroc Coffee BV
                                </td>
                                <td class="px-3 py-3 text-gray-700">
                                    {{ __('Maintenance contract upgrade') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700">
                                            {{ __('Negotiation') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900">
                                    € 12.500,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500">
                                    30-11-2025
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3 text-gray-900">
                                    Coffee & Co
                                </td>
                                <td class="px-3 py-3 text-gray-700">
                                    {{ __('New machine installation') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-700">
                                            {{ __('Won') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900">
                                    € 8.900,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500">
                                    21-11-2025
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3 text-gray-900">
                                    Roast & Brew
                                </td>
                                <td class="px-3 py-3 text-gray-700">
                                    {{ __('Service contract proposal') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-sky-100 px-2.5 py-0.5 text-xs font-medium text-sky-700">
                                            {{ __('Quote Sent') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900">
                                    € 3.600,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500">
                                    05-12-2025
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Right column --}}
                <div class="space-y-6">
                    {{-- Quick actions --}}
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 pb-3 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">
                                {{ __('Quick Actions') }}
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="#"
                                class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 text-sm text-gray-800 hover:bg-gray-50">
                                <span>{{ __('Create new quote') }}</span>
                                <span class="text-xs text-gray-400">Q</span>
                            </a>
                            <a href="{{ route('sales.overzicht') }}"
                                class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 text-sm text-gray-800 hover:bg-gray-50">
                                <span>{{ __('Overview Products') }}</span>
                                <span class="text-xs text-gray-400">C</span>
                            </a>
                            <a href="{{ route('customers.create') }}"
                                class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 text-sm text-gray-800 hover:bg-gray-50">
                                <span>{{ __('Add new customer') }}</span>
                                <span class="text-xs text-gray-400">N</span>
                            </a>
                        </div>
                    </div>

                    {{-- Top customers --}}
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 pb-3 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">
                                {{ __('Top Customers (Last 90 days)') }}
                            </h3>
                        </div>
                        <div class="p-6 space-y-4 text-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        Barroc Coffee BV
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ __('4 orders · 3 open tickets') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">
                                        € 21.300,–
                                    </p>
                                    <p class="text-xs text-emerald-600">
                                        {{ __('Key account') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        Coffee & Co
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ __('3 orders · 1 quote open') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">
                                        € 9.800,–
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ __('Growing') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">
                                        Roast & Brew
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ __('2 orders · 1 quote sent') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900">
                                        € 4.450,–
                                    </p>
                                    <p class="text-xs text-amber-500">
                                        {{ __('In pipeline') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
