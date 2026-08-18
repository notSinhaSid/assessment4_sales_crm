<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lead: {{ $lead->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg p-4 mb-4">
                <h4>Lead Details</h4>
                <table class="table">
                    <tr><th>Name</th><td>{{ $lead->name }}</td></tr>
                    <tr><th>Email</th><td>{{ $lead->email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $lead->phone }}</td></tr>
                    <tr><th>Company</th><td>{{ $lead->company }}</td></tr>
                    <tr><th>Source</th><td>{{ $lead->source }}</td></tr>
                    <tr><th>Status</th><td><span class="badge bg-secondary">{{ ucfirst($lead->status) }}</span></td></tr>
                    <tr><th>Expected Value</th><td>{{ number_format($lead->expected_value, 2) }}</td></tr>
                    <tr><th>Assigned To</th><td>{{ $lead->user->name }}</td></tr>
                </table>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Follow-Up History</h4>
                    <a href="{{ route('followups.create', $lead) }}" class="btn btn-primary btn-sm">
                        + Add Follow-Up
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lead->followUps as $followUp)
                            <tr class="{{ $followUp->status === 'pending' && $followUp->follow_up_date < now()->toDateString() ? 'table-danger' : '' }}">
                                <td>{{ $followUp->follow_up_date }}</td>
                                <td>{{ $followUp->notes }}</td>
                                <td>{{ ucfirst($followUp->status) }}</td>
                                <td>
                                    @if($followUp->status === 'pending')
                                        <form action="{{ route('followups.complete', $followUp) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-success">Mark Completed</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No follow-ups yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>