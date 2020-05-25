@component('mail::message')
# One Last Step
We just need you to confirm your email address to prove that you are who you say you are.

@component('mail::button', ['url' => env('FRONTEND_URL') . '/?confirmation_token=' . $user->confirmation_token])
    Confirm Email
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
