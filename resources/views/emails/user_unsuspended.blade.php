@component('mail::message')
# Account Restored

Hello {{ $user->name }},

Your account suspension has been lifted. You can now log in and use all features of the platform.

If you have any questions or concerns, please don't hesitate to contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
