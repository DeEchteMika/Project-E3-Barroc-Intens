@extends('layouts.app')

@section('content')
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-6 flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Customers') }}
                </h2>

                <div class="flex items-center gap-3">
                    <a href="{{ route('sales.create') }}"
                       class="inline-flex items-center px-3 py-1.5 text-sm border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        {{ __('Sales form') }}
                    </a>

                    <a href="{{ route('customers.create') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md text-white bg-amber-600 hover:bg-amber-700">
                        {{ __('Add customer') }}
                    </a>
                </div>
            </div>

            {{-- Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('status'))
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-3 py-2">{{ __('Customer No.') }}</th>
                                <th class="px-3 py-2">{{ __('Company') }}</th>
                                <th class="px-3 py-2">{{ __('Contact') }}</th>
                                <th class="px-3 py-2">{{ __('Email') }}</th>
                                <th class="px-3 py-2">{{ __('Phone') }}</th>
                                <th class="px-3 py-2">{{ __('City') }}</th>
                                <th class="px-3 py-2 text-right">{{ __('Created at') }}</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @forelse ($customers as $customer)
                                <tr class="text-gray-700">
                                    <td class="px-3 py-3 font-medium text-gray-900">
                                        {{ $customer->klantnummer ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3">
                                        {{ $customer->bedrijfsnaam ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3">
                                        {{ $customer->contactpersoon ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3">
                                        {{ $customer->email ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3">
                                        {{ $customer->telefoon ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3">
                                        {{ $customer->plaats ?? '—' }}
                                    </td>
                                    <td class="px-3 py-3 text-right text-gray-500">
                                        {{ optional($customer->created_at)->format('d-m-Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-3 py-6 text-center text-gray-500">
                                        {{ __('No customers found yet.') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $customers->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
