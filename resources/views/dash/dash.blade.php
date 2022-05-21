@extends('adminlte::page')

@section('title', 'Consultores')

@section('content_header')
<div class="card text-white bg-dark mb-3" style="max-width: 100%;">
  <div class="card-header"><h1>Consultores</h1></div>
  <div class="card-body">
    <p>Bienvenidos al dashboard de evaluación de Laravel.</p>
  </div>
</div>
    
@stop

@section('content')
    

<x-adminlte-small-box title="{{ $consultores }}" text="Cantidad de Consultores según las condiciones" icon="fas fa-user-plus text-teal"
    theme="primary" url="ganancia" url-text=""/>

<x-adminlte-small-box title="{{ $data }}" text="Cantidad de registros con ganancias" icon="fas fa-medal text-yellow"
    theme="purple" url="ganancia" url-text=""/>  
    
<x-adminlte-small-box title="Gráficos" text="Datos graficados en barra y pastel" icon="fas fa-chart-area text-red"
    theme="info" url="ganancia" url-text=""/>      

{{-- Custom --}}
<x-adminlte-profile-widget class="elevation-4" name="Alexei Leyva" desc="Web Developer"
    img="https://avatars.githubusercontent.com/u/44706810?v=4" cover="https://picsum.photos/id/541/550/200"
    header-class="text-white text-right" footer-class='bg-gradient-dark'>
    <x-adminlte-profile-row-item title="8+ years of experience with"
        class="text-center border-bottom border-secondary"/>
    <x-adminlte-profile-col-item title="Javascript" icon="fab fa-2x fa-js text-orange" size=3/>
    <x-adminlte-profile-col-item title="PHP" icon="fab fa-2x fa-php text-orange" size=3/>
    <x-adminlte-profile-col-item title="HTML5" icon="fab fa-2x fa-html5 text-orange" size=3/>
    <x-adminlte-profile-col-item title="CSS3" icon="fab fa-2x fa-css3 text-orange" size=3/>
    <x-adminlte-profile-col-item title="Angular" icon="fab fa-2x fa-angular text-orange" size=4/>
    <x-adminlte-profile-col-item title="Bootstrap" icon="fab fa-2x fa-bootstrap text-orange" size=4/>
    <x-adminlte-profile-col-item title="Laravel" icon="fab fa-2x fa-laravel text-orange" size=4/>
</x-adminlte-profile-widget>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

@stop