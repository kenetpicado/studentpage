@component('mail::message')
# <p style="text-align:center"><strong>{{config('app.centro')}}</strong></p>
<p style="text-align:center">Matricula {{date('Y', strtotime($matricula->created_at))}}</p>

@component('mail::panel')
<h4>Carnet: {{$matricula->carnet}}</h4>
<h4>PIN: {{$matricula->pin}}</h4>
@endcomponent

@component('mail::table')
|Datos de la matricula||
|:-------------|:-------------|
|||
|Nombre completo|<strong>{{$matricula->nombre}}</strong>|
|Fecha de nacimiento|{{$matricula->fecha_nac}}|
|Celular|{{$matricula->celular}}|
|Cédula|{{$matricula->cedula}}|
|Tutor|{{$matricula->tutor}}|
|Fecha de matricula|{{$matricula->created_at}}|
@endcomponent

<p style="text-align:right"><a href="javascript:window.print()">Imprimir</a></p>


@endcomponent
