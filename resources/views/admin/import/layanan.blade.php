@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h4>Import Data Layanan</h4>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    <form action="{{ route('layanan.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
@endsection
