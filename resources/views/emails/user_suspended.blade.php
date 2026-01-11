@component('mail::message')
# Account Suspended

Hello {{ $user->name }},

Your account has been suspended by our administrators.

@if($suspendedUntil)
**Suspension Period:** Until {{ $suspendedUntil->format('F j, Y') }}
@else
**Status:** Indefinite suspension
@endif

@if($reason)
**Reason:** {{ $reason }}
@endif

If you believe this is a mistake or have questions, please contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
