<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $facilities = Facility::paginate(20);
        return view('admin.facilities.index', compact('facilities'));
    }

    public function destroy(Facility $facility)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $facilityId = $facility->id;
        $facility->delete();

        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_facility',
            'target_type' => 'facility',
            'target_id' => $facilityId,
            'meta' => null,
        ]);

        return redirect()->back()->with('success', 'Facility deleted');
    }
}
