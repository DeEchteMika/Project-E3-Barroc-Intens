{{-- resources/views/customers/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Customer') }}
            </h2>

            <a href="{{ route('customers.index') }}"
               class="inline-flex items-center px-3 py-1.5 text-sm border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                {{ __('Back to customers') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('Customer details') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('Fill in the information below to create a new customer in Barroc Intens.') }}
                    </p>
                </div>

                <form action="{{ route('customers.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Basic info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700">
                                {{ __('Company Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="company_name"
                                id="company_name"
                                value="{{ old('company_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                required
                            >
                            @error('company_name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700">
                                {{ __('Contact Person') }}
                            </label>
                            <input
                                type="text"
                                name="contact_person"
                                id="contact_person"
                                value="{{ old('contact_person') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                            @error('contact_person')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                {{ __('Email') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                required
                            >
                            @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">
                                {{ __('Phone') }}
                            </label>
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                            @error('phone')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Company identifiers --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="kvk_number" class="block text-sm font-medium text-gray-700">
                                {{ __('KvK Number') }}
                            </label>
                            <input
                                type="text"
                                name="kvk_number"
                                id="kvk_number"
                                value="{{ old('kvk_number') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                            @error('kvk_number')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="vat_number" class="block text-sm font-medium text-gray-700">
                                {{ __('VAT Number (BTW)') }}
                            </label>
                            <input
                                type="text"
                                name="vat_number"
                                id="vat_number"
                                value="{{ old('vat_number') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                            @error('vat_number')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="credit_limit" class="block text-sm font-medium text-gray-700">
                                {{ __('Credit Limit (€)') }}
                            </label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="credit_limit"
                                id="credit_limit"
                                value="{{ old('credit_limit') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                            @error('credit_limit')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="space-y-4">
                        <h4 class="text-sm font-semibold text-gray-900">
                            {{ __('Address') }}
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label for="street" class="block text-sm font-medium text-gray-700">
                                    {{ __('Street') }}
                                </label>
                                <input
                                    type="text"
                                    name="street"
                                    id="street"
                                    value="{{ old('street') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                >
                                @error('street')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="house_number" class="block text-sm font-medium text-gray-700">
                                    {{ __('House Number') }}
                                </label>
                                <input
                                    type="text"
                                    name="house_number"
                                    id="house_number"
                                    value="{{ old('house_number') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                >
                                @error('house_number')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                    {{ __('Postal Code') }}
                                </label>
                                <input
                                    type="text"
                                    name="postal_code"
                                    id="postal_code"
                                    value="{{ old('postal_code') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                >
                                @error('postal_code')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="city" class="block text-sm font-medium text-gray-700">
                                    {{ __('City') }}
                                </label>
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    value="{{ old('city') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                                >
                                @error('city')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Status + notes --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                {{ __('Status') }}
                            </label>
                            <select
                                name="status"
                                id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}
                                </option>
                                <option value="prospect" {{ old('status') === 'prospect' ? 'selected' : '' }}>
                                    {{ __('Prospect') }}
                                </option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                {{ __('Internal Notes') }}
                            </label>
                            <textarea
                                name="notes"
                                id="notes"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"
                            >{{ old('notes') }}</textarea>
                            @error('notes')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('customers.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">
                            {{ __('Cancel') }}
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md border border-transparent text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500"
                        >
                            {{ __('Create Customer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
