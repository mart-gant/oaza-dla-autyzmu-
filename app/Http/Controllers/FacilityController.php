<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Facility::with(['user', 'reviews']); // Eager loading
        
        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $facilities = $query->paginate(15);
        return view('facilities.index', compact('facilities'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('facilities.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
        ]);
        
        $facility = new Facility($request->all());
        $facility->user_id = Auth::id();
        $facility->save();
        
        return redirect()->route('facilities.show', $facility)
            ->with('success', 'Placówka została pomyślnie utworzona.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Facility $facility)
    {
        $facility->load(['reviews.user']);
        return view('facilities.show', compact('facility'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Facility $facility)
    {
        // Każdy zalogowany użytkownik może edytować placówki (platforma społecznościowa)
        return view('facilities.edit', compact('facility'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Facility $facility)
    {
        // Tylko właściciel lub admin może edytować placówkę
        if ($facility->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            // Pola weryfikacji - tylko dla adminów
            'source' => 'nullable|string|max:255',
            'verification_status' => 'nullable|in:unverified,verified,certified,flagged',
            'verification_notes' => 'nullable|string|max:1000',
        ]);

        $data = $request->all();

        // Jeśli admin zmienia status weryfikacji, zapisz kto i kiedy
        if (auth()->user()->isAdmin() && $request->filled('verification_status') && $request->verification_status !== $facility->verification_status) {
            $data['verified_by'] = auth()->id();
            $data['verified_at'] = now();
        }

        $facility->update($data);

        return redirect()->route('facilities.show', $facility)
            ->with('success', 'Dane placówki zostały pomyślnie zaktualizowane.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Facility $facility)
    {
        $user = Auth::user();
        
        // Tylko admin lub właściciel może usunąć placówkę
        if ($user && ($user->isAdmin() || $facility->user_id === $user->id)) {
            $facility->delete();
            
            return redirect()->route('facilities.index')
                ->with('success', 'Placówka została pomyślnie usunięta.');
        }
        
        abort(403, 'Nie masz uprawnień do usunięcia tej placówki. Tylko administrator lub twórca może usunąć placówkę.');
    }
}
