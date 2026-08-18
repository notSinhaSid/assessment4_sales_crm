<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->role === 'admin'
            ? Lead::query()
            : Lead::where('user_id', $request->user()->id);

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by assigned user (admin only)
        if ($request->filled('user_id') && $request->user()->role === 'admin') {
            $query->where('user_id', $request->user_id);
        }

        // Filter by source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Date range filter (created_at)
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $leads = $query->with('user')->latest()->paginate(10)->withQueryString();
        $salesUsers = User::where('role', 'sales')->get();

        return view('leads.index', compact('leads', 'salesUsers'));
    }

    public function create()
    {
        $salesUsers = User::where('role', 'sales')->get();
        return view('leads.create', compact('salesUsers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:12',
            'company' => 'required|string|max:255',
            'source' => 'required|string|max:100',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
            'expected_value' => 'required|numeric',
        ]);

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully');
    }

    public function show(Lead $lead)
    {
        if (auth()->user()->role !== 'admin' && $lead->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $lead->load('followUps');
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        $salesUsers = User::where('role', 'sales')->get();
        return view('leads.edit', compact('lead', 'salesUsers'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:12',
            'company' => 'required|string|max:255',
            'source' => 'required|string|max:100',
            'status' => 'required|in:new,contacted,qualified,converted,lost',
            'expected_value' => 'required|numeric',
        ]);

        $lead->update($validated);

        return redirect()->route('leads.index')->with('success', 'Lead updated successfully');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead removed successfully');
    }
}
