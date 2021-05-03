@component('mail::message')
# Laratodos.it

Grazie per esserti registrato su Laratodos.it!

@component('mail::button', ['url' => 'http://localhost:8000'])
Vai sul sito locale
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
