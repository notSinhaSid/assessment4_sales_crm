<?php

namespace App\Http\Controllers;

use App\Models\Lead;

class ReportController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();
        $convertedLeads = Lead::where('status', 'converted')->count();
        $lostLeads = Lead::where('status', 'lost')->count();
        $totalExpectedRevenue = Lead::sum('expected_value');
        $totalConvertedRevenue = Lead::where('status', 'converted')->sum('expected_value');

        $salesUserReport = Lead::selectRaw('user_id,
                count(*) as leads_count,
                sum(case when status = "converted" then 1 else 0 end) as converted_count,
                sum(case when status = "converted" then expected_value else 0 end) as revenue')
            ->with('user')
            ->groupBy('user_id')
            ->get();

        return view('reports.index', compact(
            'totalLeads',
            'convertedLeads',
            'lostLeads',
            'totalExpectedRevenue',
            'totalConvertedRevenue',
            'salesUserReport'
        ));
    }
}