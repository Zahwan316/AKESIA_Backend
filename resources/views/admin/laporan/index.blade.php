@extends('layout.main')

@section('title', 'Laporan')

@section('content')
    <div>
        <div class='mb-1'>
            <h2>Data Laporan</h2>
        </div>
        <div class='mb-5'>
            <p>Tanggal Laporan</p>
            <form action="{{route('laporan.index')}}" method="GET">
                <input type='date' class='form-control' name='tanggal' style='margin-bottom: 10px'/>
                <button class='btn btn-primary' type="Submit">Cari</button>
            </form>
        </div>
        <div class='row'>
            <div class='col-sm-6'>
                @foreach ($data as $laporan)
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Kunjungan Tanggal {{$laporan->pemeriksaan->tanggal_kunjungan}} Jam Kunjungan {{$laporan->pemeriksaan->jam_kunjungan}}
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
                @endforeach

            </div>
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
