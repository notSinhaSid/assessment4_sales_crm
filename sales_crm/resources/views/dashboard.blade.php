<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Total Leads</h6>
                        <h3>{{ $totalLeads }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>New Leads</h6>
                        <h3>{{ $newLeads }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Follow-Ups Today</h6>
                        <h3>{{ $followUpsToday }}</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h6>Converted Leads</h6>
                        <h3>{{ $convertedLeads }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>