<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title  = 'Halaman Supplier';
        $data   = Supplier::all();

        return view('pages.supplier.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title   = 'Halaman Tambah Supplier';

        return view('pages.supplier.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'telepon'   => 'required',
            'email'     => 'required',
        ]);

        try {

            Supplier::create([
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'no_telp'   => $request->telepon,
                'email'     => $request->email,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Data Supplier Berhasil Disimpan');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $title   = 'Halaman Edit Supplier';

        return view('pages.supplier.edit', compact('title', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'telepon'   => 'required',
            'email'     => 'required',
        ]);
        try {

            $supplier->update([
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'no_telp'   => $request->telepon,
                'email'     => $request->email,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Data Supplier Berhasil Diubah');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {

            $supplier->delete();

            return redirect()->back()->with('success', 'Data Supplier Berhasil Dihapus');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
