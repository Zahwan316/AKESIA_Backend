@extends('layout.main')

@section('title', 'Pendaftaran')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data Pendaftar</h2>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Ibu</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Tanggal Pendaftaran</th>
                    <th scope="col">Keluhan</th>
                    <th scope="col">Verifikasi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $pendaftaran)
                <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$pendaftaran->ibu->user->nama_lengkap}}</td>
                    <td>{{$pendaftaran->ibu->telepon}}</td>
                    <td>{{$pendaftaran->pelayanan->nama}}</td>
                    <td>{{$pendaftaran->jam_ditentukan ?? 'Belum ditetapkan'}}</td>
                    <td>{{$pendaftaran->tanggal_pendaftaran}}</td>
                    <td>{{$pendaftaran->keluhan}}</td>
                    <td>
                        <div class='{{$pendaftaran->isVerif === 1 ? 'bg-sucess' : 'bg-danger'}} text-white p-1 rounded'>
                            {{$pendaftaran->isVerif === 1 ? 'Sudah Diverifikasi' : 'Belum Diverifikasi'}}
                        </div>
                    </td>
                    <td>
                        <div class='{{$pendaftaran->status === 'Menunggu Konfirmasi' ? 'bg-warning' : ($pendaftaran->status === 'Dibatalkan' ? 'bg-danger' : 'bg-success') }} text-white p-1 rounded d-flex justify-content-center align-items-center'>
                            {{$pendaftaran->status}}
                        </div>
                    </td>
                    <td style="display: flex, flex-direction: row">
                        <div>
                            <a href='{{route('pendaftaran.show', $pendaftaran->id)}}'>
                                <button class='btn btn-primary'>Lihat</button>
                            </a>
                        </div>
                        {{-- <button class='btn btn-danger'>Tolak</button> --}}
                        <div>
                            <form action='{{route('pendaftaran.verifikasi', $pendaftaran->id)}}' method="POST" style='display: block;'>
                                <button class='btn btn-success' type='submit'>Verifikasi</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
