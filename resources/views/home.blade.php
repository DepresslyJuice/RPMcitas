@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @if (!auth()->user()->hasRole('Cliente'))
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
    @else
        <div style="text-align: center; margin-top: 50px;">
            <h1>¡Bienvenido {{auth()->user()->name}}!</h1>
            <h2>Comuníquese con el Administrador para que se le asigne un rol</h2>
        </div>
    @endif
@stop
