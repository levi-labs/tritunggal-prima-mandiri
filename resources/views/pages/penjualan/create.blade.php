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
                        <form action="{{ route('penjualan.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode">Kode Penjualan</label>
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value={{ $kode }} readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="harga">Harga Jual</label>
                                        <input type="number" class="form-control" id="harga" name="harga"
                                            min="0" readonly>
                                        @error('harga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity"
                                            min="0">
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
                                                <option value="{{ $brg->id }}">{{ $brg->pembelian->nama . ' / ' }}
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
                                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                                        @error('tanggal')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @php
                            $total_harga = 0;
                            $total_item = 0;
                            if (isset($data_penjualan)) {
                                foreach ($data_penjualan as $item) {
                                    $total_harga += $item->subtotal;
                                    $total_item += $item->qty;
                                }
                            }

                        @endphp
                        <h4>Kode Penjualan : {{ $kode }}</h4>
                        <div class="row justify-content-end">
                            <div class="col-md-10">

                            </div>
                            <div class="col-sm-2">
                                <h6>Total Harga : {{ 'Rp. ' . number_format($total_harga, 0, ',', '.') }}</h6>
                                <h6>Total Item : {{ $total_item }}</h6>
                            </div>
                        </div>
                        <div class="table_section padding_infor_info">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($data_penjualan))
                                            @foreach ($data_penjualan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->barang->pembelian->nama }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}</td>
                                                    <td>{{ 'Rp.' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('penjualan.destroy', $item->id) }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <p>Tidak ada data</p>
                                        @endif

                                    </tbody>
                                </table>
                                <a href="{{ route('penjualan.index') }}" class="btn btn-primary btn-block">Selesai</a>
                            </div>
                        </div>
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
