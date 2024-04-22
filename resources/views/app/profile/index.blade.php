@extends('app.layout')

@section('content')  
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="mb-3 row">
                    <img src="{{ asset('cms-assets/Frame 98700.png') }}" />
                </div>
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Kandidat</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Posisi Kandidat</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->position }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection