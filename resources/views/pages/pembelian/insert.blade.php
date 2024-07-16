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
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Insert Gudang</h5>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('pembelian.insert.gudang.store', $pembelian->id) }}" method="POST">
                            @csrf
                            {{-- @php
                                dd($pembelian->id);
                            @endphp --}}
                            <input type="hidden" name="pembelian" value="{{ $pembelian->id }}">
                            <div class="form-group">
                                <label for="kode">Kode Barang</label>
                                <input type="text" class="form-control" id="kode" name="kode">
                                @error('kode')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gudang">Nama Gudang</label>
                                <select name="gudang" id="gudang" class="form-control">
                                    <option selected disabled>Pilih Gudang</option>
                                    @foreach ($gudangs as $gudang)
                                        <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                                    @endforeach
                                </select>
                                @error('gudang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Jual</label>
                                <input type="text" class="form-control" id="harga" name="harga">
                                @error('harga')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
