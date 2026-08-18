<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card p-3"><h6>Total Leads</h6><h3>{{ $totalLeads }}</h3></div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3"><h6>Converted</h6><h3>{{ $convertedLeads }}</h3></div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3"><h6>Lost</h6><h3>{{ $lostLeads }}</h3></div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3"><h6>Converted Revenue</h6><h3>{{ number_format($totalConvertedRevenue, 2) }}</h3></div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-4">
                <h4>Sales User Wise Report</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sales User</th>
                            <th>Leads</th>
                            <th>Converted</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesUserReport as $row)
                            <tr>
                                <td>{{ $row->user->name ?? 'Unassigned' }}</td>
                                <td>{{ $row->leads_count }}</td>
                                <td>{{ $row->converted_count }}</td>
                                <td>{{ number_format($row->revenue, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>