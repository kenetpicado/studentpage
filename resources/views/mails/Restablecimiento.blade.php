@component('mail::message')
# Restablecimiento de PIN

Se ha efectuado un restablecimiento de PIN 
correspondiente a este usuario. A continuación se muestran sus nuevas credenciales:

@component('mail::panel')
<h4>ID: {{ $carnet }} </h4>
<h4>PIN: {{ $pin }}</h4>
@endcomponent

Asegúrate de no perder esta información, de ser asi recuerde que siempre puede
ponerse en contacto con el administrador.

<strong>atte. {{config('app.name')}} Team</strong>

@endcomponent
