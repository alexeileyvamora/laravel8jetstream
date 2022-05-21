@extends('adminlte::page')

@section('title', 'Listado de Ganancias')

@section('content_header')

@php
$select2 = [
        "placeholder" => "Select multiple consultores...",
        "allowClear" => true,
    ];

$anyo = ['format' => 'YYYY',];
 $mes = ['format' => 'MM',];

if (isset($_GET['labelyeardesde']) || isset($_GET['labelmonthdesde']) || isset($_GET['labelyearhasta']) || isset($_GET['labelmonthhasta']))  {
    $valueyeardesde= $_GET['labelyeardesde']; 
    $valuemesdesde= $_GET['labelmonthdesde'];
    $valueyearhasta= $_GET['labelyearhasta']; 
    $valuemeshasta= $_GET['labelmonthhasta'];
 } else{
    $valuemesdesde = '';
    $valueyeardesde = '';
    $valuemeshasta = '';
    $valueyearhasta = '';
}    
@endphp

<div class="card text-white bg-dark mb-3" style="max-width: 100%;">
  <div class="card-header"><h1>Listado de Ganancias!</h1></div>
  <div class="card-body">
  <div > 

  <div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-secundary">

     <div><h4>Seleccionar Consultores</h4></div>
    <select  size="3" multiple name="izquierda" id="izquierda" style="width: 100%;height: 100%">
    @foreach($consultores as $arr)

        <option  value ="{{ $arr->co_usuario }}" > {{ $arr->no_usuario }} </option> 
         <?php 
            $arreglo[$arr->co_usuario] = $arr->no_usuario ;
         ?>        
    
    @endforeach
    </select>  
    <button type="button" class="btn btn-success" onclick="mover(izquierda,derecha)">>>>></button>
     </div>
    
    </div>
    <div class="col">
    <div class="p-3 border bg-secundary">

    <form action="{{ route ('ganancia.index') }}" method="get">

    <div><h4>Consultores Seleccionados</h4></div>
        <select class="form-select" size="3" multiple name="derecha[]" id="derecha" style="width: 100%;height: 100%">
        @foreach($Array as $dat)
                <option value ="{{ $dat }}" selected> {{ $arreglo[$dat] }} </option>        
            @endforeach

        </select>
        <button type="button" class="btn btn-danger" onclick="mover(derecha,izquierda)"><<<<</button>
    </div>
    </div>
  </div>
</div>
<br>

<div class="container">
  <div class="row row-cols-4">
    <div class="col">
    <x-adminlte-input-date id="labelmonthdesde" name="labelmonthdesde" :value="$valuemesdesde" :config="$mes" placeholder="Select mes..."
                        label="Mes desde" label-class="text-primary" igroup-size="sm">
                    </x-adminlte-input-date>
    </div>
    <div class="col">
    <x-adminlte-input-date id="labelyeardesde" name="labelyeardesde" :value="$valueyeardesde" :config="$anyo" placeholder="Select año..."
                        label="Año desde" label-class="text-primary" igroup-size="sm">
                    </x-adminlte-input-date>
    </div>
    <div class="col">
    <x-adminlte-input-date id="labelmonthhasta" name="labelmonthhasta" :value="$valuemeshasta" :config="$mes" placeholder="Select mes..."
                        label="Mes hasta" label-class="text-primary" igroup-size="sm">
                    </x-adminlte-input-date>
    </div>
    <div class="col">
    <x-adminlte-input-date id="labelyearhasta" name="labelyearhasta" :value="$valueyearhasta" :config="$anyo" placeholder="Select año..."
                        label="Año hasta" label-class="text-primary" igroup-size="sm">
                    </x-adminlte-input-date>
    </div>
  </div>
</div>
<button type="submit" class="mr-auto btn btn-primary mb-3">Relatório</button>

</form>


  </div>
</div>
    

@stop

@section('content')

@php

    $heads = [
        'Nro Mes',
        'Mes',
        'Nombre',
        'Valor',
        '% total',
        'Ganancia Neta',
        '% comision',
        'ComisionOK',
        'Costo fijo',
        'Beneficio',
    ];
                
    $config = [
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];

    
@endphp

@section('plugins.TempusDominusBs4', true)

@if(!empty($periodos))

<div class="container px-4">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 border bg-light">
    <!-- Button trigger modal graficos -->
    <x-adminlte-button icon="fas fa-chart-pie" label="Pizza" data-toggle="modal" data-target="#modalpizza" class="bg-secondary"/>    
    
    </div>
    
    </div>
    <div class="col">
    <div class="p-3 border bg-light">
    <!-- Button trigger modal graficos -->
    <x-adminlte-button icon="fas fa-chart-bar" label="Gráfico" data-toggle="modal" data-target="#modalgrafico" class="bg-secondary"/>

    </div>
    </div>
  </div>
</div>
<br>


<div class="table-responsive-sm">  
<table class="table table align-middle table-dark">

@foreach($periodos  as $key => $value) 

<thead>
  <tr>
      <th scope="row" colspan="5"> {{ $arreglo[$key] }} </th>
  </tr>
    
  <tr>
      <th scope="col">Periodos</th>
      <th scope="col">Receita Líquida</th>
      <th scope="col">Custo Fixo </th>
      <th scope="col">Comissão</th>
      <th scope="col">Lucro</th>
    </tr>
  </thead>
 
    @foreach ($value as $sub_key => $sub_val) 
                  
     @if( is_array($sub_val) ) 
           
        <thead>
        <tr>
            <th scope="row" colspan="5"> {{ $arreglo[$sub_key] }} </th>
        </tr>
            
        <tr>
            <th scope="col">periodos</th>
            <th scope="col">Receita Líquida</th>
            <th scope="col">Custo Fixo </th>
            <th scope="col">Comissão</th>
            <th scope="col">Lucro</th>
            </tr>
        </thead>            
            @foreach($sub_val as $k => $v) 
               
                <tbody>
                    <tr class="table-active">
                    <th scope="row"> {{ $v }} </th>
                    </tr>
                </tbody>    
                         
            @endforeach
         
       @else
                <tbody>
                    <tr class="table-active">
                    <th scope="row"> {{ $sub_val }} </th>
                    <th scope="row"> $R {{ $ganancia[$key][$sub_key] }} </th>
                    <th scope="row"> -$R {{ $fijo[$key][$sub_key] }} </th>
                    <th scope="row"> -$R {{ $comi[$key][$sub_key] }} </th>
                    <th scope="row"> $R {{ $benefi[$key][$sub_key] }} </th>
                    </tr>
                </tbody>              
       @endif
    @endforeach 
@endforeach
</table>
</div>
@endif

<x-adminlte-modal id="modalgrafico" title="Gráfico" size="lg" theme="primary"
    icon="fas fa-search" v-centered static-backdrop scrollable>
    <div class= "container mt-5">
        <div class= "row" >
            <div class= "col" >
                <div id= "graficom"></div>
            </div>
        </div>
    </div>
    
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>

</x-adminlte-modal>


<x-adminlte-modal id="modalpizza" title="Pizza" size="lg" theme="primary"
    icon="fas fa-search" v-centered static-backdrop scrollable>

    <div class= "container mt-2">
        <div class= "row" >
            <div class= "col" >
                <div id= "graficom1"></div>
            </div>
        </div>
    </div>

    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>

</x-adminlte-modal>

@stop

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>

<script>

    function mover(izquierda, derecha) {
        var arrizquierda = new Array();
        var arrderecha = new Array();
        var arrLookup = new Array();
        var i;
        for (i = 0; i < derecha.options.length; i++) {
            arrLookup[derecha.options[i].text] = derecha.options[i].value;
            arrderecha[i] = derecha.options[i].text;
            
        }
        var fLength = 0;
        var tLength = arrderecha.length;
        for(i = 0; i < izquierda.options.length; i++) {
            arrLookup[izquierda.options[i].text] = izquierda.options[i].value;
            if (izquierda.options[i].selected && izquierda.options[i].value != "") {
                arrderecha[tLength] = izquierda.options[i].text;
                tLength++;
            
            }
            else {
                arrizquierda[fLength] = izquierda.options[i].text;
                fLength++;
            }
        }
        arrizquierda.sort();
        arrderecha.sort();
        
        izquierda.length = 0;
        derecha.length = 0;
        var c;
            for(c = 0; c < arrizquierda.length; c++) {
            var no = new Option();
            no.value = arrLookup[arrizquierda[c]];
            no.text = arrizquierda[c];
            izquierda[c] = no;
            //izquierda[c].selected = false;
            }
            for(c = 0; c < arrderecha.length; c++) {
            var no = new Option();
            no.value = arrLookup[arrderecha[c]];
            no.text = arrderecha[c];
            derecha[c] = no;
            derecha[c].selected = true;
            //arrderecha.selected = true;
            
            
            }
    }  

    

    Highcharts.chart('graficom1', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Pizza'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            showInLegend: true,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Tipos',
        colorByPoint: true,
        data: <?= $data ?>
    }]
});


Highcharts.chart('graficom', {
    title: {
        text: 'Combination chart'
    },
    xAxis: {
        categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
    },
    labels: {
        items: [{
            html: '',
            style: {
                left: '50px',
                top: '18px',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'black'
            }
        }]
    },
    series: [{
        type: 'column',
        name: 'Mes',
        data: <?= $data ?>
    }, {
        type: 'spline',
        name: 'Average',
        data: <?= $ave ?>,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }, {
        type: 'pie',
        name: '',
        data: <?= $data ?>,
        center: [100, 80],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: false
        }
    }]
});

</script>
@stop
