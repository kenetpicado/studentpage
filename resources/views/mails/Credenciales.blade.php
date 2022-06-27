@component('mail::message')
# ¡Bienvenido!

<p>
Ha sido registrado al sistema administrativo de <strong>{{config('app.centro')}}.</strong> 
</p>

<p>
A continuación, se muestran sus credenciales
con las que podrá realizar las gestiones administrativas que
le correspondan según su rol:
</p>

@component('mail::panel')
<h4>ID: {{$user->carnet}} </h4>
<h4>PIN: {{$user->pin}}</h4>
@endcomponent

<p>
Asegúrate de no perder esta información, de ser asi, recuerde que siempre puede
ponerse en contacto con el administrador.
</p>

<small><strong>{{config('app.name')}} Team</strong> </small>

@endcomponent
