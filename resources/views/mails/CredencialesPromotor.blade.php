@component('mail::message')
# ¡Bienvenido Promotor!

Se ha registrado el usuario <strong>{{ $promotor->nombre }}</strong> 
con el correo <strong> {{ $promotor->correo }}</strong> 
a nuestro sistema administrativo.

A continuación, se muestran sus credenciales
con las que podrá realizar las gestiones administrativas que
le correspondan según su rol:

@component('mail::panel')
<h4>ID: {{ $promotor->carnet }} </h4>
<h4>PIN: {{ $pin }}</h4>
@endcomponent

Asegúrate de no perder esta información, de ser asi recuerde que siempre puede
ponerse en contacto con el administrador.

<strong>atte. {{config('app.name')}} Team</strong>

@endcomponent
