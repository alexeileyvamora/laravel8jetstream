@extends('adminlte::page')

@section('title', 'PizzaController')

@section('content_header')
<div class="card text-white bg-dark mb-3" style="max-width: 100%;">
  <div class="card-header"><h1>Pizza y Gráfico!</h1></div>
  <div class="card-body">
  <p>Bienvenidos!!!.</p>
  </div>
</div>
    
@stop

@section('content')
    
    <div class= "container mt-5">
        <div class= "row" >
            <div class= "col" >
                <div id= "container"></div>
            </div>
        </div>
    </div>

    <div class= "container mt-5">
        <div class= "row" >
            <div class= "col" >
                <div id= "container1"></div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Porcentaje'
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



//Promedios

Highcharts.chart('container1', {
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
    }, /*{
        type: 'column',
        name: 'John',
        data: [2, 3, 5, 7, 6]
    }, {
        type: 'column',
        name: 'Joe',
        data: [4, 3, 3, 9, 0]
    },*/{
        type: 'spline',
        name: 'Average',
        data: <?= $average ?>,
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
