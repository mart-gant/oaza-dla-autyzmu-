<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        $facilities = Facility::paginate(20);
        return response()->json($facilities);
    }

    public function destroy(Facility $facility)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        $facility->delete();
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_facility',
            'target_type' => 'facility',
            'target_id' => $facility->id,
            'meta' => null,
        ]);

        return response()->json(['message' => 'Facility deleted']);
    }
}
