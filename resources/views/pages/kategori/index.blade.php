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
                            <h2>Daftar Kategori</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mx-4">
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">

                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                <a href="{{ route('kategori.edit', $item->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <form action="{{ route('kategori.destroy', $item->id) }}" class="d-inline"
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
