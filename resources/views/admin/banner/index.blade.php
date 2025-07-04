@extends('layout.main')

@section('title', 'Banner')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Banner</h2>
        </div>
        <div class='mb-5'>
            <x-button route="{{ route('banner.create',) }}" color="btn-primary">
                + Tambah Banner
            </x-button>
        </div>
        <table class="table table-striped table-hover table-bordered table-responsive w-full">
            <thead class="">
                <tr style="vertical-align: middle">
                    <th style="vertical-align: middle" scope="col">No</th>
                    <th scope="col">Nama Banner</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!@empty($data))
                @if($data->isEmpty())
                    <tr>
                        <td colspan="9" rowspan="9" class="w-full"  style="vertical-align: middle">
                            <div class='d-flex justify-content-center align-items-center'>
                                <x-empty >
                                    Belum ada data banner
                                </x-empty>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($data as $key => $banner)
                    <tr>
                        <th scope="row">{{ $data->firstItem() + $key }}</th>
                        <td>{{$banner->name}}</td>
                        <td>
                            <img
                                src='{{asset($banner->upload->path)}}'
                                style="width: 300px; height: 200px; object-fit: contain"
                            />
                        </td>
                        <td>
                            <x-button route="{{ route('banner.edit', $banner->id) }}" color="btn-primary">
                                Edit
                            </x-button>
                            <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" class="d-inline delete-form">
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
                {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
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
