@extends('adminlte::page')

@section('title', 'Listado de consultores')

@section('content_header')

    <h1>Listado Consultores!</h1>
    
@stop

@section('content')

@php
    $heads = [
        'Nombre',
        'Acción',

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
        'columns' => [null, null, null, ['orderable' => true]],
    ];

@endphp

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-success" type="button" id="button-addon2">Button</button>
</div>

@php
    $config = [
        "placeholder" => "Select multiple consultores...",
        "allowClear" => true,
    ];
@endphp

<x-adminlte-select2 id="sel2Category" name="sel2Category[]" label="Consultores"
    label-class="text-danger" igroup-size="sm" :config="$config" multiple>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-red">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>

    
    @foreach($resultado as $dat)
    <option>{{ $dat->no_usuario }} </option>
                
    @endforeach
</x-adminlte-select2>


@php
$config = ['format' => 'DD/MM/YYYY'];
@endphp
<x-adminlte-input-date name="idLabel" :config="$config" placeholder="Choose a date..."
    label="Datetime" label-class="text-primary">
    <x-slot name="appendSlot">
        <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-birthday-cake"
            title="Set to Birthday"/>
    </x-slot>
</x-adminlte-input-date>

@section('plugins.TempusDominusBs4', true)

    <x-adminlte-datatable id="table1" head-theme="dark" :heads="$heads" theme="light" export striped hoverable >
    
        @foreach($resultado as $dat)
            <tr>
                <th scope="row">{{ $dat->no_usuario }}   </th>
             
                <td> <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalles">
                    <i class="fa fa-eye"></i>
                </button>   </td>

                    
            </tr>

        @endforeach

    </x-adminlte-datatable>
    
@stop

@section('css')
    
@stop

@section('js')

@stop

@section('plugins.Select2', true)