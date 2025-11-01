@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Edit Data Peminjaman</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="image" class="form-label">Foto Peminjam</label><br>
            @if ($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Foto" class="img-thumbnail mb-2" style="max-width: 150px;">
            @endif
            <input type="file" name="image" id="image" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
        </div>

        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input 
                type="text" 
                name="judul_buku" 
                id="judul_buku" 
                class="form-control" 
                value="{{ old('judul_buku', $post->judul_buku) }}" 
                placeholder="Masukkan Judul Buku">
        </div>

        <div class="mb-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input 
                type="text" 
                name="nama_peminjam" 
                id="nama_peminjam" 
                class="form-control" 
                value="{{ old('nama_peminjam', $post->nama_peminjam) }}" 
                placeholder="Masukkan Nama Peminjam">
        </div>

        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input 
                type="date" 
                name="tanggal_pinjam" 
                id="tanggal_pinjam" 
                class="form-control" 
                value="{{ old('tanggal_pinjam', $post->tanggal_pinjam) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
            <input 
                type="date" 
                name="tanggal_kembali" 
                id="tanggal_kembali" 
                class="form-control" 
                value="{{ old('tanggal_kembali', $post->tanggal_kembali) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="dipinjam" {{ old('status', $post->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ old('status', $post->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
