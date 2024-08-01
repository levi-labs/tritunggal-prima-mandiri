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
                            <h2>Daftar Barang Belum Masuk Gudang</h2>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 mx-4">
                            {{-- <a href="{{ route('pembelian.create') }}" class="btn btn-primary">Tambah</a> --}}
                        </div>
                        <div class="col-md-5 mx-4 text-right">
                            <div class="dropdown_section float-right">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">Status Pembelian</button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                        style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" href="{{ route('pembelian.index.gudang') }}">Pembelian</a>
                                        <a class="dropdown-item"
                                            href="{{ route('pembelian.index.gudang', ['status' => 'gudang']) }}">Gudang</a>
                                    </div>
                                </div>
                            </div>
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
                                        @if (isset($item->barang->harga_jual))
                                            <th>Gudang</th>
                                            <th>Harga Jual</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>

                                            @if (isset($item->barang->harga_jual))
                                                <td>{{ $item->barang->gudang->nama }}</td>
                                                <td>{{ $item->barang->harga_jual }}</td>
                                            @endif

                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->role == 'administrator' || Auth::user()->role == 'gudang')
                                                    @if ($item->status !== 'gudang')
                                                        <a href="{{ route('pembelian.insert.gudang', $item->id) }}"
                                                            class="btn btn-warning">Accept</a>
                                                    @elseif ($item->status === 'gudang')
                                                        <a href="{{ route('pembelian.edit.item.gudang', $item->id) }}"
                                                            class="btn btn-info">Edit</a>
                                                    @endif
                                                @endif



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
