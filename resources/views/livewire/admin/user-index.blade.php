<div>
    <div class="card">
        <div class="card-header">
            <!-- Campo de entrada de búsqueda -->
            <input wire:model="search" class="form-control" placeholder="Buscar usuarios..." />

            <!-- Botón de búsqueda -->
            <button wire:click="searchUsers" class="btn btn-primary mt-2">Buscar</button>
        </div>

        @if ($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{ route('admin.users.edit', $item) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros...</strong>
            </div>
        @endif

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
</div>
