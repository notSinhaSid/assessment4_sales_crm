<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leads
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-4">

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('leads.create') }}" class="btn btn-primary mb-3">
                        + Add Lead
                    </a>
                @endif

                {{-- Filter form --}}
                <form method="GET" action="{{ route('leads.index') }}" class="row g-2 mb-3">
                    <div class="col-auto">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="form-control">
                    </div>

                    <div class="col-auto">
                        <select name="status" class="form-control">
                            <option value="">All Statuses</option>
                            @foreach(['new', 'contacted', 'qualified', 'converted', 'lost'] as $status)
                                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <div class="col-auto">
                            <select name="user_id" class="form-control">
                                <option value="">All Sales Users</option>
                                @foreach($salesUsers as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-auto">
                        <select name="source" class="form-control">
                            <option value="">All Sources</option>
                            @foreach(['website', 'call', 'referral'] as $source)
                                <option value="{{ $source }}" {{ request('source') === $source ? 'selected' : '' }}>
                                    {{ ucfirst($source) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>
                    <div class="col-auto">
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Expected Value</th>
                            <th>Assigned To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->company }}</td>
                                <td>{{ $lead->source }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($lead->status) }}</span>
                                </td>
                                <td>{{ number_format($lead->expected_value, 2) }}</td>
                                <td>{{ $lead->user->name }}</td>
                                <td>
                                    <a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-info">View</a>

                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Delete this lead?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No leads found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $leads->links() }}

            </div>
        </div>
    </div>
</x-app-layout>