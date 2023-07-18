{{-- @component('mail::message')
    # Assignment Assigned

    Hello {{ $user->name }},

    You have been assigned a new assignment.

    Assignment Name: {{ $assignment->name }}

    @component('mail::button', ['url' => route('assignments.show', $assignment)])
        View Assignment
    @endcomponent

    Thank you for your attention.

    Regards,
    {{ config('app.name') }}
@endcomponent --}}

<h1>Hi, {{ $name }}</h1>
l<p>Sending Mail from Laravel.</p>