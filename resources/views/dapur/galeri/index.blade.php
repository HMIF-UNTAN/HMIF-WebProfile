@extends('layouts.dapur')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Galeri HMIF</h1>
        <div>
            <a href="{{ route('galeri.downloadSeeder') }}" class="btn btn-success me-2">Download Seeder</a>
            <a href="{{ route('tambahalbum') }}" class="btn btn-primary">+ Tambah Album</a>
        </div>
    </div>
    
    <div class="row mt-4">
        @foreach ($galeri as $album)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>{{ $album->nama_album }}</h5>
                        <p><small>ID Folder: {{ $album->google_drive_folder_id }}</small></p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('galeri.edit', $album->id) }}" class="btn btn-sm btn-outline-secondary">Edit Album</a>
                        
                            <form action="{{ route('galeri.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                        
                    </div>              
                </div>
            </div>
        @endforeach
    </div>
@endsection
