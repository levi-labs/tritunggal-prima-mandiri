@extends('layout.main')
@section('content')
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-truck orange_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $supplier }}</p>
                            <p class="head_couter">Supplier</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-calculator blue1_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $pembelian }}</p>
                            <p class="head_couter">Pembelian</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-shopping-cart green_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $penjualan }}</p>
                            <p class="head_couter">Penjualan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-dollar red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ number_format($sales->total, 0, ',', '.') }}</p>
                            <p class="head_couter">Total Sales</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChar2"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const cts = document.getElementById('myChar2');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartPembelian->pluck('nama')->toArray()) !!},
                datasets: [{
                    label: 'Pembelian',
                    data: {!! json_encode($chartPembelian->pluck('qty')->toArray()) !!},
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(cts, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartPenjualan->pluck('nama')->toArray()) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($chartPenjualan->pluck('qty')->toArray()) !!},
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
