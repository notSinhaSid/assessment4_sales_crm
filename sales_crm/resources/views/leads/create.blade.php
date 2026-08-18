<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Lead</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-4">

                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    @include('leads.partials.form', ['lead' => null, 'salesUsers' => $salesUsers])
                    <button type="submit" class="btn btn-primary mt-3">Create Lead</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>