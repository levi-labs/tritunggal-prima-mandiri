<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->has('kode_penjualan')) {
            session()->forget('kode_penjualan');
        }
        $title  = 'Halaman Penjualan';
        $data   = Penjualan::select('kode')->groupBy('kode')->get();



        return view('pages.penjualan.index', compact('title', 'data'));
    }

    public function getBarang(Request $request)
    {
        try {
            $data = Barang::where('id', $request->id)->first();

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Halaman Tambah Penjualan';

        $penjualan = new Penjualan();
        if (session()->has('kode_penjualan')) {
            $kode  = session()->get('kode_penjualan');
            $data_penjualan = Penjualan::where('kode', $kode)->get();
        } else {
            $kode  = $penjualan->generateKode();
            $data_penjualan = null;
        }

        $barang = Barang::select('id', 'pembelian_id')->with(['pembelian' => function ($query) {
            $query->select('id', 'nama', 'kode');
        }])->get();

        return view('pages.penjualan.create', compact(
            'title',
            'barang',
            'kode',
            'data_penjualan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'barang' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'tanggal' => 'required',
        ]);
        dd($request->all());
        DB::beginTransaction();

        try {

            $penjualan = new Penjualan();
            $penjualan->kode = $request->kode;
            $penjualan->barang_id = $request->barang;
            $barang = Barang::where('id', $request->barang)->first();
            if ($barang->stok < $request->quantity) {

                DB::rollBack();
                return redirect()->back()->with('error', 'Stok Tidak Cukup');
            } elseif ($barang->stok >= $request->quantity) {
                $barang->stok = $barang->stok - $request->quantity;

                $penjualan->qty = $request->quantity;
                $penjualan->harga = $request->harga;
                $penjualan->subtotal = $request->quantity * $request->harga;
                $penjualan->tanggal = $request->tanggal;
                $penjualan->save();
                $barang->save();

                DB::commit();

                session()->put('kode_penjualan', $request->kode);
                return redirect()->back()->with('success', 'Data Penjualan Berhasil Ditambahkan');
            }
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($kode)
    {
        $title      = 'Halaman Detail Penjualan';
        $data  = Penjualan::where('kode', $kode)->get();
        session()->put('kode_penjualan', $kode);
        return view('pages.penjualan.detail', compact('title', 'data'));
    }

    public function addOther()
    {
        $title = 'Halaman Tambah Penjualan';

        $penjualan = new Penjualan();
        if (session()->has('kode_penjualan')) {
            $kode  = session()->get('kode_penjualan');
            $data_penjualan = Penjualan::where('kode', $kode)->get();
        } else {
            $kode  = $penjualan->generateKode();
            $data_penjualan = null;
        }

        $barang = Barang::select('id', 'pembelian_id')->with(['pembelian' => function ($query) {
            $query->select('id', 'nama', 'kode');
        }])->get();

        return view('pages.penjualan.create', compact(
            'title',
            'barang',
            'kode',
            'data_penjualan'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $title = 'Halaman Edit Data Penjualan';
        $barang = Barang::select('id', 'pembelian_id')->with(['pembelian' => function ($query) {
            $query->select('id', 'nama', 'kode');
        }])->get();
        return view('pages.penjualan.edit', compact('title', 'penjualan', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $this->validate($request, [
            'barang' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'tanggal' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $barang = Barang::where('id', $request->barang)->first();
            $temp_qty = $penjualan->qty + $barang->stok;
            if ($barang->stok < $request->quantity) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Stok Tidak Cukup');
            } elseif ($barang->stok >= $request->quantity) {
                $barang->stok = $temp_qty - $request->quantity;
                $penjualan->qty = $request->quantity;
                $penjualan->harga = $request->harga;
                $penjualan->subtotal = $request->quantity * $request->harga;
                $penjualan->tanggal = $request->tanggal;
                $penjualan->save();
                $barang->save();

                DB::commit();
                return redirect()->route('penjualan.index')->with('success', 'Data Penjualan Berhasil Diupdate');
            }
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        DB::beginTransaction();
        try {
            $barang = Barang::where('id', $penjualan->barang_id)->first();
            $barang->stok = $barang->stok + $penjualan->qty;
            $barang->save();

            $penjualan->delete();

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deleteByKode($kode)
    {
        DB::beginTransaction();
        try {
            $penjualan = Penjualan::where('kode', $kode)->get();
            foreach ($penjualan as $value) {
                $barang = Barang::where('id', $value->barang_id)->first();
                $barang->stok = $barang->stok + $value->qty;
                $barang->save();
                Penjualan::where('id', $value->id)->delete();
            }

            DB::commit();
            return back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
