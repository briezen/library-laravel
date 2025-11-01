@extends('layout')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 1000px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .btn {
        display: inline-block;
        padding: 8px 14px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        color: #fff;
        margin:8px;
        margin-right: 5px;
        margin-left: 2px;
    }

    .btn-primary { background-color: #007bff; }
    .btn-warning { background-color: #ffc107; color: #000; }
    .btn-danger  { background-color: #dc3545; }
    .btn-info    { background-color: #17a2b8; }
    .btn-secondary { background-color: #6c757d; }

    .alert {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    th {
        background-color: #333;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100px;
        max-height: 100px;
        border-radius: 10px;
    }
</style>

<div class="container">
    <h1>Daftar Peminjaman Buku</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah Data</a>

    @if ($message = Session::get('success'))
        <div class="alert">
            {{ $message }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Foto Peminjam</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perpus as $p)
            <tr>
                <td>
                    @if ($p->image)
                        <img src="{{ asset('storage/images/' . $p->image) }}" 
                             alt="Foto {{ $p->nama_peminjam }}">
                    @else
                        <span style="color: gray;">No Image</span>
                    @endif
                </td>
                <td>{{ $p->nama_peminjam }}</td>
                <td>{{ $p->judul_buku }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                <td>{{ $p->status ?? 'dipinjam' }}</td>
                <td>
                    <a href="{{ route('posts.show', $p->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('posts.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('posts.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
