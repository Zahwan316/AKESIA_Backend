@extends('layout.main')

@section('title', 'Bidan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data Bidan</h2>
            <p class='text-danger' style='font-weight: bold'>Mohon untuk dibaca, akun bidan akan muncul jika bidan sudah mengisi data dengan lengkap di aplikasi akesia yang ada di hp!</p>
            <p class='text-danger' style='font-weight: bold'>Fitur ini hanya untuk menambahkan akun agar bidan bisa login ke aplikasi!</p>
        </div>
        <div class='mb-5'>
            <x-button route="{{ route('bidan.create',) }}" color="btn-primary">
                + Tambah Bidan
            </x-button>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive w-full">
            <thead class="">
                <tr style="vertical-align: middle">
                    <th style="vertical-align: middle" scope="col">No</th>
                    <th scope="col">Nama Bidan</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status Keanggotaan</th>
                    <th scope="col">No Str</th>
                    <th scope="col">No Sip</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!@empty($data))
                @if($data->isEmpty())
                    <tr>
                        <td colspan="9" rowspan="9" class="w-full"  style="vertical-align: middle">
                            <div class='d-flex justify-content-center align-items-center'>
                                <img
                                    src='{{asset('img/emptydata.png')}}'
                                    class='w-25'
                                />
                                <h3>Belum ada data bidan</h3>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($data as $key => $bidan)
                    <tr>
                        <th scope="row">{{ $data->firstItem() + $key }}</th>
                        <td>{{$bidan->user->nama_lengkap}}</td>
                        <td>{{$bidan->user->email}}</td>
                        <td>{{$bidan->status_keanggotaan_ibi}}</td>
                        <td>{{$bidan->no_STR}}</td>
                        <td>{{$bidan->no_SIP}}</td>
                        <td>
                            <x-button route="{{ route('bidan.edit', $bidan->id) }}" color="btn-primary">
                                Edit
                            </x-button>
                            <form action="{{ route('bidan.destroy', $bidan->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger show_confirm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            @endif
        </table>

        @if(!empty($data))
            <div class="d-flex justify-content-center mt-3">
                {{ $data->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <script>
        // Konfirmasi saat klik tombol hapus
        document.querySelectorAll('.show_confirm').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
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
