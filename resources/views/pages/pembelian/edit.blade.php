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
                    <div class="card-body">
                        <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode">Kode Pembelian</label>
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value={{ $pembelian->kode }} readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value={{ $pembelian->nama }}>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan"
                                            value={{ $pembelian->satuan }}>
                                        @error('satuan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="0" value={{ $pembelian->qty }}>
                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Beli</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            min="0" value={{ $pembelian->harga }}>
                                        @error('harga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <select name="supplier" id="supplier" class="form-control">
                                            <option selected disabled>Pilih Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option {{ $supplier->id == $pembelian->supplier_id ? 'selected' : '' }}
                                                    value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('supplier')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option {{ $kategori->id == $pembelian->kategori_id ? 'selected' : '' }}
                                                    value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Pembelian</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value={{ $pembelian->tanggal }}>
                                        @error('tanggal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto Barang</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                        {{ $pembelian->foto }}
                                        @error('foto')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
