<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Follow-Up for {{ $lead->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-4">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('followups.store', $lead) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Follow-Up Date</label>
                        <input type="date" name="follow_up_date"
                               value="{{ old('follow_up_date') }}"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="4" required>{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Follow-Up</button>
                    <a href="{{ route('leads.show', $lead) }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>