<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $check_url = request()->get('status');

        if ($check_url === 'gudang') {
            $title  = 'Halaman Daftar Pembelian di Gudang';

            $data = Pembelian::where('status', 'gudang')->get();
            $head_gudang = 'Gudang';
            $head_harga = 'Harga Jual';
            return view('pages.pembelian.index', compact(
                'title',
                'data',
                'head_gudang',
                'head_harga'
            ));
        } else {
            $title  = 'Halaman Pembelian ';
            // dd('false');
            $data   = Pembelian::where('status', 'pending')->get();

            return view('pages.pembelian.index', compact('title', 'data'));
        }
        // $data   = Pembelian::all();


    }
    public function indexGudang()
    {


        $check_url = request()->get('status');

        if ($check_url === 'gudang') {
            $title  = 'Halaman Daftar Barang di Gudang';
            $data = Pembelian::where('status', 'gudang')->get();
        } else {
            // dd('false');
            $title  = 'Halaman Daftar Masuk Gudang';
            $data   = Pembelian::where('status', 'pending')->get();
        }
        // $data   = Pembelian::all();

        return view('pages.pembelian.index-gudang', compact('title', 'data'));
    }
    public function insertBarangToGudang(Pembelian $pembelian)
    {

        $title  = 'Halaman Insert Barang ke Gudang';
        $gudangs = Gudang::select('id', 'nama')->get();

        return view('pages.pembelian.insert', compact(
            'title',
            'pembelian',
            'gudangs'
        ));
    }

    public function insertBarangToGudangStore(Request $request, Pembelian $pembelian)
    {
        $this->validate($request, [
            'kode' => 'required',
            'gudang' => 'required',
            'harga' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $barang                 = new Barang();
            $barang->pembelian_id   = $request->pembelian;
            $barang->gudang_id      = $request->gudang;
            $barang->kode           = $request->kode;
            $barang->harga_jual     = $request->harga;
            $barang->stok           = $pembelian->qty;
            $barang->save();

            $pembelian->update([
                'status' => 'gudang'
            ]);
            DB::commit();
            return redirect()->route('pembelian.index')->with('success', 'Barang Berhasil Ditambah ke Gudang');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function editItemGudang(Pembelian $pembelian)
    {

        $title  = 'Halaman Edit Item Gudang';
        $barang = Barang::where('pembelian_id', $pembelian->id)->first();
        $gudangs = Gudang::all();
        // dd($barang);
        return view('pages.pembelian.update', compact(
            'title',
            'pembelian',
            'barang',
            'gudangs'
        ));
    }

    public function updateItemGudang(Request $request, Pembelian $pembelian)
    {

        $this->validate($request, [
            'kode' => 'required',
            'gudang' => 'required',
            'harga' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $barang                 = Barang::where('pembelian_id', $pembelian->id)->first();
            $barang->pembelian_id   = $request->pembelian;
            $barang->gudang_id      = $request->gudang;
            $barang->kode           = $request->kode;
            $barang->harga_jual     = $request->harga;
            $barang->update();
            DB::commit();
            return redirect()->route('pembelian.index.gudang')->with('success', 'Barang Berhasil Diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title      = 'Halaman Tambah Pembelian';
        $pembelian  = new Pembelian();
        $suppliers  = Supplier::select('id', 'nama')->get();
        $kategoris  = Kategori::select('id', 'nama')->get();
        $kode       = $pembelian->generateKode();

        return view('pages.pembelian.create', compact(
            'title',
            'kode',
            'suppliers',
            'kategoris'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode'      => 'required',
            'supplier'  => 'required',
            'kategori'  => 'required',
            'nama'      => 'required',
            'quantity'  => 'required',
            'satuan'    => 'required',
            'harga'     => 'required',
            'foto'      => 'required',
            'tanggal'   => 'required',
        ]);
        try {
            $pembelian = new Pembelian();
            $pembelian->kode = $request->kode;
            $pembelian->supplier_id = $request->supplier;
            $pembelian->kategori_id = $request->kategori;
            $pembelian->nama = $request->nama;
            $pembelian->qty = $request->quantity;
            $pembelian->satuan = $request->satuan;
            $pembelian->harga = $request->harga;
            $pembelian->tanggal = $request->tanggal;

            $image = $request->file('foto');

            if ($image) {
                $filename   = time() . '.' . $image->getClientOriginalExtension();
                $path       = $image->storeAs('images', $filename);
                $pembelian->foto = $path;
            }
            $pembelian->save();

            return redirect()->route('pembelian.index')->with('success', 'Data Berhasil Ditambah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        $title = 'Halaman Detail Pembelian';

        return view('pages.pembelian.detail', compact('title', 'pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        $title = 'Halaman Edit Pembelian';
        $suppliers = Supplier::select('id', 'nama')->get();
        $kategoris = Kategori::select('id', 'nama')->get();
        return view('pages.pembelian.edit', compact(
            'title',
            'pembelian',
            'suppliers',
            'kategoris',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        $this->validate($request, [
            'kode'      => 'required',
            'supplier'  => 'required',
            'kategori'  => 'required',
            'nama'      => 'required',
            'quantity'  => 'required',
            'satuan'    => 'required',
            'harga'     => 'required',
            'tanggal'   => 'required',
        ]);
        try {
            $pembelian = Pembelian::find($pembelian->id);
            $pembelian->kode = $request->kode;
            $pembelian->supplier_id = $request->supplier;
            $pembelian->kategori_id = $request->kategori;
            $pembelian->nama = $request->nama;
            $pembelian->qty = $request->quantity;
            $pembelian->satuan = $request->satuan;
            $pembelian->harga = $request->harga;
            $pembelian->tanggal = $request->tanggal;
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $filename   = time() . '.' . $image->getClientOriginalExtension();
                $path       = $image->storeAs('images', $filename);
                if ($pembelian->foto !== null) {
                    Storage::delete($pembelian->foto);
                }
                $pembelian->foto = $path;
                $pembelian->save();
            } else {
                $pembelian->foto = $pembelian->foto;
                $pembelian->save();
            }

            return redirect()->route('pembelian.index')->with('success', 'Data Berhasil Diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        try {
            if ($pembelian->foto !== null) {
                Storage::delete($pembelian->foto);
            }
            $pembelian->delete();
            return redirect()->route('pembelian.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
