<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

class TwoFactorAuthenticationController extends Controller
{
    /**
     * Enable two-factor authentication for the user.
     */
    public function store(Request $request, EnableTwoFactorAuthentication $enable)
    {
        $enable($request->user());
        
        $request->user()->update([
            'two_factor_confirmed_at' => now(),
        ]);

        return back()->with('status', 'two-factor-authentication-enabled');
    }

    /**
     * Disable two-factor authentication for the user.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return back()->with('status', 'two-factor-authentication-disabled');
    }

    /**
     * Show recovery codes.
     */
    public function showRecoveryCodes(Request $request)
    {
        return back()->with([
            'recoveryCodes' => $request->user()->two_factor_recovery_codes,
        ]);
    }

    /**
     * Regenerate recovery codes.
     */
    public function regenerateRecoveryCodes(Request $request, GenerateNewRecoveryCodes $generate)
    {
        $generate($request->user());

        return back()->with([
            'recoveryCodes' => $request->user()->two_factor_recovery_codes,
            'status' => 'recovery-codes-generated',
        ]);
    }
}
