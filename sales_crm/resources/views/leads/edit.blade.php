<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Lead</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-4">

                <form action="{{ route('leads.update', $lead) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('leads.partials.form', ['lead' => $lead, 'salesUsers' => $salesUsers])
                    <button type="submit" class="btn btn-primary mt-3">Update Lead</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>