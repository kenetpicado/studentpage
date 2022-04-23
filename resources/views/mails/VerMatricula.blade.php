@component('mail::message')
# {{config('app.centro')}}
Matricula {{date('Y', strtotime($matricula->created_at))}}
<br>
<br>
@component('mail::panel')
Datos de la matricula
@endcomponent
<br>
@component('mail::table')
|Carnet|{{$matricula->carnet}}|
|:-------------|:-------------|
|PIN|{{$matricula->pin}}|
|Nombre completo|<strong>{{$matricula->nombre}}</strong>|
|Fecha de nacimiento|{{$matricula->fecha_nac}}|
|Teléfono|{{$matricula->tel}}|
|Cédula|{{$matricula->cedula}}|
|Nombre de la Madre|{{$matricula->madre}}|
|Nombre del Padre|{{$matricula->padre}}|
|Fecha de matricula|{{$matricula->created_at}}|
@endcomponent

<a href="javascript:window.print()">Imprimir</a>

@endcomponent
