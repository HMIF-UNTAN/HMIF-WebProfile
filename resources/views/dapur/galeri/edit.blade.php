@extends('layouts.dapur')

@section('content')
<div class="container">
    <h2>Kelola Album: {{ $album->nama_album }}</h2>

    {{-- Form Upload Foto --}}
    <form action="{{ route('galeri.upload', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="custom_name" class="form-label">Nama Foto Dasar (opsional)</label>
            <input type="text" class="form-control" name="custom_name" id="custom_name" placeholder="Contoh: dokumentasi">
        </div>
    
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto</label>
            <input type="file" class="form-control" name="foto[]" id="foto" multiple required>
        </div>
    
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>    

    {{-- Daftar Foto (jika sudah dibuat fungsi ambil foto) --}}
    <hr>
    <h5>Daftar Foto</h5>
    <div class="scrollable-foto-section p-2 border rounded" style="max-height: 350px; overflow-y: auto; overflow-x: hidden">
        <div class="row">
            @forelse ($files as $file)
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="embed-responsive-custom">
                            <iframe 
                                src="{{ $file['previewUrl'] }}" 
                                title="{{ $file['name'] }}"
                                allow="autoplay" 
                                style="border: none; width: 100%; height: 100%;"
                            ></iframe>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-truncate">{{ $file['name'] }}</p>
                            <a href="{{ $file['webViewLink'] }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                            <form action="{{ route('galeri.hapus', ['id' => $album->id, 'fileId' => $file['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>                                                                      
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Tidak ada foto di album ini.</p>
            @endforelse
        </div>
    </div>        
</div>
@endsection
