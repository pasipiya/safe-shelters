@component('mail::message')
# New User Registration

{{$user_name}} has registered for an account. Check the Admin Panel for further information about this shelter and verify their legitimacy.


Thank you,<br>
{{ config('app.name') }}
@endcomponent
