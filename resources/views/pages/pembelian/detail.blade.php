@extends('layout.main')

@section('content')
    <div class="container-fluid">
        <div class="row-column-title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="card-title">Data Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('/storage/' . $pembelian->foto) }}" alt="img-barang">
                            </div>
                            <div class="col-md-8">

                                <h4>{{ $pembelian->nama . ' | ' . $pembelian->kode }}</h4>
                                <p> Satuan : {{ $pembelian->satuan }}</p>
                                <p> Quantity : {{ $pembelian->qty }}</p>
                                <p> Harga Beli :{{ $pembelian->harga }}</p>
                                <p> Tanggal Pembelian : {{ $pembelian->tanggal }}</p>
                                <hr>
                                <p>Nama Supplier : {{ $pembelian->supplier->nama }}</p>
                                <p>Alamat : {{ $pembelian->supplier->alamat }}</p>
                                <p>No. Telp : {{ $pembelian->supplier->no_telp }}</p>
                                <hr>
                                <div class="badge badge-dark">{{ $pembelian->kategori->nama }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
