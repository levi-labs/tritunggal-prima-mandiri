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
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2 mx-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger mt-2 mx-2">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Daftar Detail Penjualan</h2>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 mx-4 mt-3">
                            <a href="{{ route('penjualan.add.other') }}" class="btn btn-primary">Tambah</a>
                            <a href="{{ route('penjualan.invoice', $kode) }}" class="btn btn-secondary"
                                target="_blank">Print</a>
                        </div>

                    </div>
                    <div class="table_section padding_infor_info">

                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pembelian</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->barang->pembelian->nama }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ 'Rp. ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('penjualan.edit', $item->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <form action="{{ route('penjualan.destroy', $item->id) }}" class="d-inline"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
