@extends('layouts.dapur')

@section('content')
    <h1>Data Pengurus</h1>
    <a href="{{ route('tambahpengurus') }}" class="btn btn-primary mb-3">Tambah Pengurus</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengurus as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->nim }}</td>
                        <td>{{ $p->kepengurusan->divisi->nama }}</td>
                        <td>{{ $p->kepengurusan->jabatan }}</td>
                        <td>{{ $p->kepengurusan->periode }}</td>
                        <td>
                            <a href="{{ route('pengurus.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                            <form action="{{ route('pengurus.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>                        
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection
