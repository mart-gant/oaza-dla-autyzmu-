<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\User;
use App\Models\Facility;

class VisitController extends Controller
{
    /**
     * Display the user's visits.
     */
    public function myVisits()
    {
        $user = Auth::user();
        $visits = Visit::where('user_id', $user->id)
            ->with(['specialist', 'facility'])
            ->orderBy('visit_date', 'desc')
            ->get();

        return view('my-visits', ['visits' => $visits]);
    }

    /**
     * Show the form for creating a new visit.
     */
    public function create()
    {
        $specialists = User::where('is_specialist', true)->get();
        $facilities = Facility::all();
        
        return view('visits.create', compact('specialists', 'facilities'));
    }

    /**
     * Store a newly created visit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'specialist_id' => 'nullable|exists:users,id',
            'facility_id' => 'nullable|exists:facilities,id',
            'visit_date' => 'required|date',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Visit::create($validated);

        return redirect()->route('my-visits')
            ->with('success', 'Wizyta została dodana pomyślnie!');
    }

    /**
     * Show the form for editing the visit.
     */
    public function edit(Visit $visit)
    {
        // Sprawdź czy użytkownik może edytować tę wizytę
        if ($visit->user_id !== Auth::id()) {
            abort(403, 'Nie masz uprawnień do edycji tej wizyty.');
        }

        $specialists = User::where('is_specialist', true)->get();
        $facilities = Facility::all();
        
        return view('visits.edit', compact('visit', 'specialists', 'facilities'));
    }

    /**
     * Update the specified visit.
     */
    public function update(Request $request, Visit $visit)
    {
        // Sprawdź czy użytkownik może edytować tę wizytę
        if ($visit->user_id !== Auth::id()) {
            abort(403, 'Nie masz uprawnień do edycji tej wizyty.');
        }

        $validated = $request->validate([
            'specialist_id' => 'nullable|exists:users,id',
            'facility_id' => 'nullable|exists:facilities,id',
            'visit_date' => 'required|date',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $visit->update($validated);

        return redirect()->route('my-visits')
            ->with('success', 'Wizyta została zaktualizowana pomyślnie!');
    }

    /**
     * Remove the specified visit.
     */
    public function destroy(Visit $visit)
    {
        // Sprawdź czy użytkownik może usunąć tę wizytę
        if ($visit->user_id !== Auth::id()) {
            abort(403, 'Nie masz uprawnień do usunięcia tej wizyty.');
        }

        $visit->delete();

        return redirect()->route('my-visits')
            ->with('success', 'Wizyta została usunięta pomyślnie!');
    }
}
