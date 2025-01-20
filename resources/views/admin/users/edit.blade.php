@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
            
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <!-- Mostrar el nombre como texto no editable -->
                    <p class="form-control-plaintext">{{ $user->name }}</p>
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <!-- Mostrar el email como texto no editable -->
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                </div>
            
                <div class="form-group">
                    <label for="roles">Roles</label>
                    @foreach($roles as $role)
                        <div>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-1"
                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </div>
                    @endforeach
                </div>
            
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@stop

@section('content')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
