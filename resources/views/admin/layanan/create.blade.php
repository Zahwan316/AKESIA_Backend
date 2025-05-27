@extends('layout.main')

@section('title', 'Tambah Layanan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>
                Tambah Layanan
            </h2>

        </div>
        <div class='w-50'>
            <form action="{{route('layanan.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Layanan</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                    <label>Jenis Layanan</label>
                    <select class="form-control" name='jenis_layanan_id'>
                        <option value=''>Pilih Jenis Layanan</option>
                        @foreach ($jenis_layanan as $item)
                            <option value='{{$item->id}}'>{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Layanan</label>
                    <input type="number" class="form-control" id='only-number' name="harga">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class='form-control' style="text-align: left; padding-top: 0.5rem;resize: none;" rows="5" name='keterangan'>
                    </textarea>
                </div>
                <div class="form-group">
                    <label>Formulir</label>
                    <select class='form-control' name="formulir_id">
                        <option>Pilih Formulir</option>
                        @foreach ($ref_jenis_form as $formulir)
                            <option value='{{$formulir->id}}'>{{$formulir->name}}</option>
                        @endforeach
                        <option>Formulir Bersalin + Nifas + Bayi + Lainnya</option>
                    </select>
                </div>
                <x-button type='submit'>
                    Kirim
                </x-button>
            </form>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        </div>
    </div>

    <script>
        document.getElementById('only-number').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // hanya angka
        });
    </script>

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
