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
                        <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                            </div>

                            <div class="col-md-6">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
