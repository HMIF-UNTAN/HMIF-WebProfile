@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Admin</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('updateAdmin', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select">
                        <option value="">— Hapus Role —</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Pilih "Hapus Role" jika ingin mencabut peran admin pengguna ini.</small>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small>(Kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('dapurSuperadmin') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
