@extends('adminlte::page')

@section('title', '| Dashboard')

@section('content_header')
    <h1>CALENDARIO</h1>
@stop

@section('content')
    <div>
        <div wire:ignore id="calendario-semanal">
            <livewire:calendarios.calendario-semanal />
        </div>
        <div wire:ignore id="calendario-diario" style="display: none;">
            <livewire:calendarios.calendario-diario />
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('mostrar-diario', () => {
                document.getElementById('calendario-semanal').style.display = 'none';
                document.getElementById('calendario-diario').style.display = 'block';
            });

            Livewire.on('mostrar-semanal', () => {
                document.getElementById('calendario-semanal').style.display = 'block';
                document.getElementById('calendario-diario').style.display = 'none';
            });
        });
    </script>
@stop
