@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Peminjaman Buku</h2>

    <div class="card shadow-sm p-4">
        <div class="text-center mb-3">
            @if ($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" 
                     alt="Foto Peminjam" 
                     class="img-fluid rounded" 
                     style="max-width: 250px;">
            @else
                <p><em>Tidak ada foto</em></p>
            @endif
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Nama Peminjam</th>
                <td>{{ $post->nama_peminjam }}</td>
            </tr>
            <tr>
                <th>Judul Buku</th>
                <td>{{ $post->judul_buku }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ $post->tanggal_pinjam }}</td>
            </tr>
            <tr>
                <th>Tanggal Kembali</th>
                <td>{{ $post->tanggal_kembali ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $post->status }}</td>
            </tr>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
