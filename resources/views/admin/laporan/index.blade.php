@extends('layout.main')

@section('title', 'Laporan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data Laporan</h2>
        </div>
        <div class='mb-5'>
            <p>Tanggal Laporan</p>
            <form action="{{route('laporan.index')}}" method="GET">
                <input type='date' class='form-control' name='tanggal' style='margin-bottom: 10px' value={{request('tanggal') ?? now()->toDateString()}} />
                <button class='btn btn-primary' type="Submit">Cari</button>
            </form>
        </div>
        <div class='row mb-3'>
            @foreach ($data as $laporan)
            <div class='col-sm-5 mb-3'>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Kunjungan Tanggal <b>{{$laporan->pemeriksaan->tanggal_kunjungan}}</b> Jam Kunjungan <b>{{$laporan->pemeriksaan->jam_kunjungan}}</b>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><span style='font-weight: bold;'>Nama Pendaftar : </span>{{$laporan->ibu->user->nama_lengkap}}</p>
                        <p><span style='font-weight: bold;'>Jenis Pasien : </span>{{$laporan->jenis_pasien}}</p>
                        <p><span style='font-weight: bold;'>Kunjungan ke </span>{{$laporan->total_kunjungan}}</p>
                        <a href='{{route('laporan.show', $laporan->id)}}'>
                            <button class='btn btn-primary'>Lihat</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
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
