@component('mail::message')
# Role Updated

Hello {{ $user->name }},

Your account role has been updated.

**New Role:** {{ ucfirst($newRole) }}

This change may affect your access to certain features and administrative functions.

If you have questions about your new role, please contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
