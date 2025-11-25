@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Card --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">
                        {{ __('Create Customer') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('Fill in the details below to create a new customer record.') }}
                    </p>
                </div>

                <div class="px-6 py-6">
                    {{-- Validation errors --}}
                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                            <p class="font-semibold mb-1">{{ __('There were some problems with your input:') }}</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customers.store') }}" class="space-y-6">
                        @csrf

                        {{-- Basic info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Company name --}}
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700">
                                    {{ __('Company Name') }} <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="company_name"
                                    name="company_name"
                                    type="text"
                                    required
                                    value="{{ old('company_name') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            {{-- Contact person --}}
                            <div>
                                <label for="contact_person" class="block text-sm font-medium text-gray-700">
                                    {{ __('Contact Person') }}
                                </label>
                                <input
                                    id="contact_person"
                                    name="contact_person"
                                    type="text"
                                    value="{{ old('contact_person') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    {{ __('Email') }} <span class="text-red-500">*</span>
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    value="{{ old('email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">
                                    {{ __('Phone') }}
                                </label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    value="{{ old('phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label for="street" class="block text-sm font-medium text-gray-700">
                                    {{ __('Street') }}
                                </label>
                                <input
                                    id="street"
                                    name="street"
                                    type="text"
                                    value="{{ old('street') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            <div>
                                <label for="house_number" class="block text-sm font-medium text-gray-700">
                                    {{ __('House Number') }}
                                </label>
                                <input
                                    id="house_number"
                                    name="house_number"
                                    type="text"
                                    value="{{ old('house_number') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                    {{ __('Postal Code') }}
                                </label>
                                <input
                                    id="postal_code"
                                    name="postal_code"
                                    type="text"
                                    value="{{ old('postal_code') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">
                                    {{ __('City') }}
                                </label>
                                <input
                                    id="city"
                                    name="city"
                                    type="text"
                                    value="{{ old('city') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>
                        </div>

                        {{-- Company data --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="kvk_number" class="block text-sm font-medium text-gray-700">
                                    {{ __('KvK Number') }}
                                </label>
                                <input
                                    id="kvk_number"
                                    name="kvk_number"
                                    type="text"
                                    value="{{ old('kvk_number') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            <div>
                                <label for="vat_number" class="block text-sm font-medium text-gray-700">
                                    {{ __('VAT Number') }}
                                </label>
                                <input
                                    id="vat_number"
                                    name="vat_number"
                                    type="text"
                                    value="{{ old('vat_number') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>

                            <div>
                                <label for="credit_limit" class="block text-sm font-medium text-gray-700">
                                    {{ __('Credit Limit (€)') }}
                                </label>
                                <input
                                    id="credit_limit"
                                    name="credit_limit"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    value="{{ old('credit_limit') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                            </div>
                        </div>

                        {{-- Status + notes --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">
                                    {{ __('Status') }}
                                </label>
                                <select
                                    id="status"
                                    name="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >
                                    <option value="">{{ __('Select status') }}</option>
                                    <option value="prospect" @selected(old('status') === 'prospect')>
                                        {{ __('Prospect') }}
                                    </option>
                                    <option value="active" @selected(old('status') === 'active')>
                                        {{ __('Active') }}
                                    </option>
                                    <option value="on_hold" @selected(old('status') === 'on_hold')>
                                        {{ __('On hold') }}
                                    </option>
                                    <option value="inactive" @selected(old('status') === 'inactive')>
                                        {{ __('Inactive') }}
                                    </option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">
                                    {{ __('Notes') }}
                                </label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                           focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                >{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('customers.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium
                                           rounded-md bg-indigo-600 text-white hover:bg-indigo-700
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Save Customer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
