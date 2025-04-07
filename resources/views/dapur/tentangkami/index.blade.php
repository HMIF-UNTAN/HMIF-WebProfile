@extends('layouts.dapur')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Data Tentang Kami</h2>
    <form method="GET" action="{{ route('dapurtentangkami') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
        </div>
        
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>    
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tentangkamis as $index => $tentangkami)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tentangkami->judul }}</td>
                    <td>
                        @php
                            $konten = $tentangkami->konten;
                        @endphp

                        @if(is_array($konten) && count($konten) > 1)
                            <ol>
                                @foreach($konten as $poin)
                                    <li>{{ $poin }}</li>
                                @endforeach
                            </ol>
                        @else
                            <p>{{ is_array($konten) ? $konten[0] : $konten }}</p>
                        @endif
                    </td>
                    
                    <td>
                        <a href="{{ route('tentangkami.edit', $tentangkami->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tentangkami.destroy', $tentangkami->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
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
        {{ $tentangkamis->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    
    <div class="mt-3">
        <a href="{{ route('tambahtentangkami') }}" class="btn btn-primary">Tambah Artikel Baru</a>
    </div>
</div>
@endsection
