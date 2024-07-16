<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $title = 'Halaman Gudang';
        $data  = Gudang::all();
        return view('pages.gudang.index', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Halaman Tambah Gudang';
        return view('pages.gudang.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $data = $request->all();
            Gudang::create($data);

            return redirect(route('gudang.index'))->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Gudang $gudang)
    {
        $title = 'Halaman Edit Gudang';
        return view('pages.gudang.edit', compact('title', 'gudang'));
    }

    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        try {
            $data = $request->all();
            $gudang->update($data);
            return redirect(route('gudang.index'))->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Gudang $gudang)
    {
        try {
            $gudang->delete();
            return redirect(route('gudang.index'))->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
