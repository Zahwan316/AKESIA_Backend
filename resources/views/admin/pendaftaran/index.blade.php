@extends('layout.main')

@section('title', 'Pendaftaran')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data Pendaftar</h2>
        </div>
        <div class='mb-5'>
            <p>Tanggal Pendaftaran</p>
            <form action="{{route('pendaftaran.index')}}" method="GET">
                <input type='date' class='form-control' name='tanggal' style='margin-bottom: 10px' value={{request('tanggal') ?? now()->toDateString()}} />
                <button class='btn btn-primary' type="Submit">Cari</button>
            </form>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive w-full">
            <thead class="">
                <tr style="vertical-align: middle">
                    <th style="vertical-align: middle" scope="col">No</th>
                    <th scope="col">Nama Ibu</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Tanggal Ditentukan</th>
                    <th scope="col">Keluhan</th>

                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($data->isEmpty())
                    <tr>
                        <td colspan="9" rowspan="9" class="w-full"  style="vertical-align: middle">
                            <div class='d-flex justify-content-center align-items-center'>
                                <img
                                    src='{{asset('img/emptydata.png')}}'
                                    class='w-25'
                                />
                                <h3>Belum ada data yang masuk hari ini</h3>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($data as $key => $pendaftaran)
                    <tr>
                        <th scope="row">{{ $data->firstItem() + $key }}</th>
                        <td>{{$pendaftaran->ibu->user->nama_lengkap}}</td>
                        <td>{{$pendaftaran->ibu->telepon}}</td>
                        <td>{{$pendaftaran->pelayanan->nama}}</td>
                        <td>{{$pendaftaran->jam_ditentukan ?? 'Belum ditetapkan'}}</td>
                        <td>{{$pendaftaran->tanggal_pendaftaran}}</td>
                        <td>{{$pendaftaran->keluhan}}</td>
                        {{-- <td>
                            <div class='{{$pendaftaran->isVerif === 1 ? 'bg-success' : 'bg-danger'}} text-white p-1 rounded'>
                                {{$pendaftaran->isVerif === 1 ? 'Sudah Diverifikasi' : 'Belum Diverifikasi'}}
                            </div>
                        </td> --}}
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
                            {{-- <div>
                                <form action='{{route('pendaftaran.verifikasi', $pendaftaran->id)}}' method="POST" style='display: block;'>
                                    @method('PUT')
                                    @csrf
                                    <button class='btn btn-success' type='submit'>Verifikasi</button>
                                </form>
                            </div> --}}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
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
