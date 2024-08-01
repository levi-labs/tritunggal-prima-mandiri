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
                            <h2>Daftar Pembelian</h2>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-6 mx-4">
                            <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah</a>
                        </div>

                    </div>
                    <div class="table_section padding_infor_info">

                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Penjualan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td class="text-center">

                                                <a href="{{ route('penjualan.show', $item->kode) }}"
                                                    class="btn btn-secondary">Detail</a>
                                                <form action="{{ route('penjualan.destroy', $item->kode) }}"
                                                    class="d-inline" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
