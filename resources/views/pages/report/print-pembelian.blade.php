@extends('layout-print.body')
@section('surat')
    <div class="table-print">
        <button id="btn-print" class="d-print-table" onclick="window.print()">Print</button>
        <center>
            <h3>LAPORAN PEMBELIAN</h3>
            <h4>Berikut adalah hasil laporan dari Periode {{ $from ?? 'Awal Periode' }} - {{ $to ?? 'Akhir Periode' }}</h4>
        </center>
        <table class="table table-bordered d-print-table" width="100%" border="2"
            style="border-collapse: collapse; border: 2px solid black;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Pembelian</th>
                    <th>Supplier</th>
                    <th>Kategori</th>
                    <th>Barang</th>
                    <th>Satuan</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>SubTotal</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach ($data as $item)
                    @php
                        $total += $item->qty * $item->harga;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->supplier }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td class="font-small">{{ $item->nama }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->qty * $item->harga }}</td>

                    </tr>
                @endforeach

                <tr>
                    <td colspan="7" class="text-center">Total</td>
                    <td colspan="3">{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.print();
        })
    </script>
@endsection
