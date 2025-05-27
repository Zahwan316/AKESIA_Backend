@extends('layout.main')

@section('title', 'Tambah Bidan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>
                Tambah Akun Bidan
            </h2>

        </div>
        <div class='w-50'>
            <form action="{{route('bidan.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Bidan</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Password Bidan</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <x-button type='submit' >
                    Kirim
                </x-button>
            </form>
        </div>
    </div>

@endsection

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}'
        });
    </script>
@endif
