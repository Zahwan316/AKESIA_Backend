@extends('layout.main')

@section('title', 'layanan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data layanan</h2>
        </div>
        <div class='mb-5'>
            <x-button route="{{ route('layanan.create',) }}" color="btn-primary">
                + Tambah layanan
            </x-button>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive w-full">
            <thead class="">
                <tr style="vertical-align: middle">
                    <th style="vertical-align: middle" scope="col">No</th>
                    <th scope="col">Nama layanan</th>
                    <th scope="col">Jenis Layanan</th>
                    <th scope="col">Harga Layanan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Nama Formulir</th>
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
                                <h3>Belum ada data layanan</h3>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($data as $key => $layanan)
                    <tr>
                        <th scope="row">{{ $data->firstItem() + $key }}</th>
                        <td>{{$layanan->nama}}</td>
                        <td>{{$layanan->jenis_layanan->nama}}</td>
                        <td>Rp{{number_format($layanan->harga, 0, ',', '.')}}</td>
                        <td>{{$layanan->keterangan}}</td>
                        <td>
                            @foreach($layanan->formItems as $formItem)
                                {{ $formItem->form->name }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td>
                            <x-button route="{{ route('layanan.edit', $layanan->id) }}" color="btn-primary">
                                Edit
                            </x-button>
                            <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" class="d-inline delete-form">
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
        <div class="d-flex justify-content-center mt-3">
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
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
