@extends('adminlte::page')

@section('title', '| Dashboard')

@section('content_header')
    <h1>CALENDARIO</h1>
@stop

@section('content')
    @livewire('calendarios.calendario')

@stop

@section('css')


@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
