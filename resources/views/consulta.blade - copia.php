@extends('adminlte::page')

@section('title', 'Listado de consultores')

@section('content_header')
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laravel 8 Pagination</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <h1>Consultores!</h1>
@stop

@section('content')
    <p>Bienvenidos a esta evaluación de proyecto!!!.</p>

      {{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Name',
    'Name',
    'Name',
    ['label' => 'Phone', 'width' => 40],
    
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
               
$config = [

    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];

@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($resultado as $dat)
        <tr>
        <th scope="row">{{ $dat->co_usuario}}  </th>
                            <td> {{ $dat->no_usuario }}  </td>
                            <td> {{ $dat->co_sistema }}  </td>
                            <td> {{ $dat->in_ativo }}  </td>
                            <td> {{ $dat->co_tipo_usuario }}  </td>
        </tr>
    @endforeach
</x-adminlte-datatable>
    
    @section('plugins.Datatables', true)
    @section('plugins.DatatablesPlugin', true)

    <div class="container mt-5">
            <table class="table table-striped table-responsive">
                <thead>
                <tr>
                    <th scope="col" width="1%">#</th>
                    <th scope="col" width="15%">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="10%">Username</th>
                    <th scope="col" width="10%">Username</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($resultado as $dat)
                        <tr>
                            <th scope="row">{{ $dat->co_usuario}}  </th>
                            <td> {{ $dat->no_usuario }}  </td>
                            <td> {{ $dat->co_sistema }}  </td>
                            <td> {{ $dat->in_ativo }}  </td>
                            <td> {{ $dat->co_tipo_usuario }}  </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

       
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
@stop

@section('js')
@stop
