@component('mail::message')
#Gracias {{$name}}


El ticket FOLIO{{$ticket}} fue registrado con éxito.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
