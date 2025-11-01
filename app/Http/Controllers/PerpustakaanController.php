<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerpustakaanController extends Controller
{
    public function index()
    {
        $perpus = Perpustakaan::all();
        return view('posts.index', compact('perpus'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul_buku' => 'nullable|string|max:255',
                'nama_peminjam' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'nullable|date',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $image->storeAs('images', $imageName, 'public');
            }

            Perpustakaan::create([
                'image' => $imageName,
                'judul_buku' => $request->judul_buku,
                'nama_peminjam' => $request->nama_peminjam,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => $request->status ?? 'dipinjam',
            ]);

            return redirect()->route('posts.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(Perpustakaan $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Perpustakaan $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Perpustakaan $post)
    {
        $validatedData = $request->validate([
            'judul_buku' => 'nullable|string|max:255',
            'nama_peminjam' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
        ]);

        $imageName = $post->image;
        if ($request->hasFile('image')) {
            if ($imageName) {
                Storage::disk('public')->delete('images/' . $imageName);
            }
            $imageFile = $request->file('image');
            $imageName = $imageFile->hashName();
            $imageFile->storeAs('images', $imageName, 'public');
        }

        $post->update([
            'image' => $imageName,
            'judul_buku' => $request->judul_buku,
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status ?? 'dipinjam',
        ]);

        return redirect()->route('posts.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Perpustakaan $post)
    {
        try {
            if ($post->image) {
                Storage::disk('public')->delete('images/' . $post->image);
            }

            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
