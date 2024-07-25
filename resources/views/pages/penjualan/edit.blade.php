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
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode">Kode Penjualan</label>
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value={{ $penjualan->kode }} readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Jual</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            min="0" value={{ $penjualan->harga }} readonly>
                                        @error('harga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="0" value={{ $penjualan->qty }}>
                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    {{-- @php
                                        dd($barang);
                                    @endphp --}}
                                    <div class="form-group">
                                        <label for="barang">Nama Barang</label>
                                        <select name="barang" id="barang" class="form-control">
                                            <option selected disabled>Pilih Barang</option>
                                            @foreach ($barang as $brg)
                                                <option {{ $penjualan->barang_id == $brg->id ? 'selected' : '' }}
                                                    value="{{ $brg->id }}">{{ $brg->pembelian->nama . ' / ' }}
                                                    {{ $brg->pembelian->kode }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('barang')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Penjualan</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value={{ $penjualan->tanggal }}>
                                        @error('tanggal')
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
    <script>
        $(document).ready(function() {
            $('#barang').on('change', function() {
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "{{ route('penjualan.getbarang') }}",
                    method: 'GET',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#harga').val(data.harga_jual).attr('readonly', true);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            });
        });
    </script>
@endsection
