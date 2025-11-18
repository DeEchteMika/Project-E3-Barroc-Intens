<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales Overview') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Top stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('Today\'s Revenue') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            € 4.250,–
                        </p>
                        <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">
                            +18% {{ __('vs. yesterday') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('Open Quotes') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            12
                        </p>
                        <p class="mt-1 text-xs text-amber-600 dark:text-amber-400">
                            {{ __('Follow-up needed within 3 days') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('Active Customers') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            37
                        </p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ __('Last 30 days') }}
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('Conversion Rate') }}
                        </p>
                        <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                            32%
                        </p>
                        <p class="mt-1 text-xs text-emerald-600 dark:text-emerald-400">
                            {{ __('Improved this week') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Main content: left = pipeline, right = quick actions + top customers --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Sales pipeline --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="px-6 pt-6 pb-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ __('Sales Pipeline') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Overview of current opportunities and their status.') }}
                        </p>
                    </div>
                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead>
                            <tr class="text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <th class="px-3 py-2">{{ __('Customer') }}</th>
                                <th class="px-3 py-2">{{ __('Project') }}</th>
                                <th class="px-3 py-2">{{ __('Stage') }}</th>
                                <th class="px-3 py-2 text-right">{{ __('Value') }}</th>
                                <th class="px-3 py-2 text-right">{{ __('Expected Close') }}</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-3 py-3 text-gray-900 dark:text-gray-100">
                                    Barroc Coffee BV
                                </td>
                                <td class="px-3 py-3 text-gray-700 dark:text-gray-300">
                                    {{ __('Maintenance contract upgrade') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-amber-100 dark:bg-amber-900/40 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:text-amber-300">
                                            {{ __('Negotiation') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900 dark:text-gray-100">
                                    € 12.500,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500 dark:text-gray-400">
                                    30-11-2025
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3 text-gray-900 dark:text-gray-100">
                                    Coffee & Co
                                </td>
                                <td class="px-3 py-3 text-gray-700 dark:text-gray-300">
                                    {{ __('New machine installation') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-emerald-100 dark:bg-emerald-900/40 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:text-emerald-300">
                                            {{ __('Won') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900 dark:text-gray-100">
                                    € 8.900,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500 dark:text-gray-400">
                                    21-11-2025
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3 text-gray-900 dark:text-gray-100">
                                    Roast & Brew
                                </td>
                                <td class="px-3 py-3 text-gray-700 dark:text-gray-300">
                                    {{ __('Service contract proposal') }}
                                </td>
                                <td class="px-3 py-3">
                                        <span class="inline-flex items-center rounded-full bg-sky-100 dark:bg-sky-900/40 px-2.5 py-0.5 text-xs font-medium text-sky-700 dark:text-sky-300">
                                            {{ __('Quote Sent') }}
                                        </span>
                                </td>
                                <td class="px-3 py-3 text-right text-gray-900 dark:text-gray-100">
                                    € 3.600,–
                                </td>
                                <td class="px-3 py-3 text-right text-gray-500 dark:text-gray-400">
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
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 pb-3 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('Quick Actions') }}
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="#"
                               class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-sm text-gray-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700/60">
                                <span>{{ __('Create new quote') }}</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">Q</span>
                            </a>
                            <a href="#"
                               class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-sm text-gray-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700/60">
                                <span>{{ __('Log a follow-up call') }}</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">C</span>
                            </a>
                            <a href="#"
                               class="flex items-center justify-between px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-sm text-gray-800 dark:text-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700/60">
                                <span>{{ __('Add new customer') }}</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">N</span>
                            </a>
                        </div>
                    </div>

                    {{-- Top customers --}}
                    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <div class="px-6 pt-6 pb-3 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('Top Customers (Last 90 days)') }}
                            </h3>
                        </div>
                        <div class="p-6 space-y-4 text-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        Barroc Coffee BV
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('4 orders · 3 open tickets') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        € 21.300,–
                                    </p>
                                    <p class="text-xs text-emerald-600 dark:text-emerald-400">
                                        {{ __('Key account') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        Coffee & Co
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('3 orders · 1 quote open') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        € 9.800,–
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Growing') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">
                                        Roast & Brew
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('2 orders · 1 quote sent') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">
                                        € 4.450,–
                                    </p>
                                    <p class="text-xs text-amber-500 dark:text-amber-300">
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
</x-app-layout>
