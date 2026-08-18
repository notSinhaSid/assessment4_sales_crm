<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function create(Lead $lead)
    {
        return view('followups.create', compact('lead'));
    }

    public function store(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'follow_up_date' => 'required|date',
            'notes' => 'required|string',
        ]);

        $lead->followUps()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return redirect()->route('leads.show', $lead)->with('success', 'Follow-up added.');
    }

    public function complete(FollowUp $followUp)
    {
        $followUp->update(['status' => 'completed']);
        return back()->with('success', 'Follow-up marked as completed.');
    }
}
