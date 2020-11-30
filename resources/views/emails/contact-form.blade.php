@component('mail::message')
# {{$contactMessage->subject}}

Email: {{$contactMessage->email}}
<br><br>
Message: {{$contactMessage->msg}}


Thank you,<br>
{{$contactMessage->name}}
@endcomponent