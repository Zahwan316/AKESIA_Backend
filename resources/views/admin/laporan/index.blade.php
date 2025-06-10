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
        <div class='row mb-3 w-100'>
            <div class="w-100">
                <table class="table table-striped table-hover table-bordered w-100">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Pendaftar</th>
                            <th scope="col">Jenis Pasien</th>
                            <th scope="col">Total Kunjungan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->isEmpty())
                        <tr>
                            <td rowspan="4" class='d-flex justify-content-center align-items-center'>
                                <img
                                    src='{{asset('img/emptydata.png')}}'
                                    class='w-25'
                                />
                                <h3>Belum ada data yang masuk hari ini</h3>
                            </td>
                        </tr>
                        @else
                        @foreach ($data as $index => $laporan)
                        <tr>
                            <td>{{ $data->firstItem() + $index }}</td>
                            <td>{{ $laporan->pemeriksaan->tanggal_kunjungan }} {{ $laporan->pemeriksaan->jam_kunjungan }}</td>
                            <td>{{ $laporan->ibu->user->nama_lengkap }}</td>
                            <td>{{ $laporan->jenis_pasien }}</td>
                            <td>{{ $laporan->total_kunjungan }}</td>
                            <td>
                                <a href="{{ route('laporan.show', $laporan->id) }}">
                                    <button class="btn btn-primary">Lihat</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
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
