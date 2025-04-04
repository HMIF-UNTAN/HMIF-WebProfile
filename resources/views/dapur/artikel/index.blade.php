@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Artikel</h2>
    <form method="GET" action="{{ route('dapurartikel') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
        </div>
        
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Kegiatan</option>
                <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                <option value="past" {{ request('status') === 'past' ? 'selected' : '' }}>Sudah Terlaksana</option>
            </select>
        </div>
    
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Terlama → Terbaru</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Terbaru → Terlama</option>
            </select>
        </div>
    
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>    
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Slug</th>
                <th>Tanggal Kegiatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikels as $index => $artikel)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $artikel->judul }}</td>
                    <td>{{ $artikel->slug }}</td>
                    <td>{{ $artikel->tanggal_kegiatan->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Ga Ada Bray</td>
                </tr>    
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $artikels->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    
    <div class="mt-3">
        <a href="{{ route('tambahArtikel') }}" class="btn btn-primary">Tambah Artikel Baru</a>
    </div>
</div>
@endsection
