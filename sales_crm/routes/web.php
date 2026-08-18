<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Models\FollowUp;
use App\Models\Lead;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalLeads' => Lead::count(),
        'newLeads' => Lead::where('status', 'new')->count(),
        'followUpsToday' => FollowUp::whereDate('follow_up_date', today())->count(),
        'convertedLeads' => Lead::where('status', 'converted')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Follow-ups (specific, literal paths — safe to declare early)
    Route::get('/leads/{lead}/followups/create', [FollowUpController::class, 'create'])->name('followups.create');
    Route::post('/leads/{lead}/followups', [FollowUpController::class, 'store'])->name('followups.store');
    Route::patch('/followups/{followUp}/complete', [FollowUpController::class, 'complete'])->name('followups.complete');

    // Leads index — any authenticated user (scoped inside controller by role)
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');

    // Admin-only lead management (create, store, edit, update, destroy)
    Route::middleware('role:admin')->group(function () {
        Route::resource('/leads', LeadController::class)->except(['index', 'show']);
    });

    // Reports — admin only
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');

});

require __DIR__.'/auth.php';