<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perpustakaan extends Model
{
    protected $table = 'perpustakaan';
    protected $fillable = ['nama_peminjam', 'judul_buku', 'image', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
}
