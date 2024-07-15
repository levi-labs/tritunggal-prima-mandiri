<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Halaman Kategori';

        $data  = Kategori::all();

        return view('pages.kategori.index', compact('title', 'data'));
    }

    public function create()
    {

        $title = 'Halaman Tambah Kategori';

        return view('pages.kategori.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        try {
            Kategori::create([
                'kode' => $request->kode,
                'nama' => $request->nama
            ]);

            return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Kategori $kategori)
    {

        $title = 'Halaman Edit Kategori';

        return view('pages.kategori.edit', compact('title', 'kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        try {
            $kategori->update([
                'kode' => $request->kode,
                'nama' => $request->nama
            ]);

            return redirect()->route('kategori.index')->with('success', 'Data Kategori Berhasil Diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return redirect()->back()->with('success', 'Data Kategori Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
