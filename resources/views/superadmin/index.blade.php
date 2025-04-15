@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color: #0C0221;">Manajemen Admin</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge 
                                    {{ $role->name == 'superadmin' ? 'bg-danger' : 
                                        ($role->name == 'admin' ? 'bg-primary' : 'bg-secondary') }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('editAdmin', $user->id) }}" class="btn btn-sm text-white" style="background-color: #0F4696;">
                                Edit
                            </a>
                            <form action="{{ route('hapusAdmin', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #8B0000;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
