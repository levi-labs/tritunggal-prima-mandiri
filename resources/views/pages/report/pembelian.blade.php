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
                        <h5 class="card-title">Form Report Pembelian</h5>
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
                        <form action="{{ route('report.pembelian.post') }}" method="POST" target="_blank">
                            @csrf

                            <div class="form-group">
                                <label for="from">Dari Tanggal</label>
                                <input type="date" class="form-control" id="from" name="from">
                                @error('from')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="to">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="to" name="to">
                                @error('to')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="button" id='submit' class="btn btn-primary" disabled>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let from = document.getElementById('from');
            let to = document.getElementById('to');
            let submit = document.getElementById('submit');

            from.addEventListener('change', function() {
                if (from.value === '' && to.value === '') {
                    submit.setAttribute('type', 'button');
                } else if (from.value !== '' || to.value !== '') {
                    submit.setAttribute('type', 'submit');
                    submit.removeAttribute('disabled');
                }
            })

            to.addEventListener('change', function() {
                if (from.value === '' && to.value === '') {
                    submit.setAttribute('type', 'button');
                } else if (from.value !== '' || to.value !== '') {
                    submit.setAttribute('type', 'submit');
                    submit.removeAttribute('disabled');
                }
            })

        })
    </script>
@endsection
