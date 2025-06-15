@extends('layout.main')

@section('title', 'Edit Jenis Layanan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>
                Edit Jenis Layanan
            </h2>

        </div>
        <div class='w-50'>
            <form action="{{route('jenis_layanan.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type='hidden' name='_method' value='POST' /> --}}
                <div class="form-group">
                    <label>Nama Jenis Layanan</label>
                    <input type="text" class="form-control" name="nama" value='{{$data->nama}}'>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <Textarea name='keterangan' class='form-control' style='resize: none;' rows="4">{{$data->keterangan}}</Textarea>

                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" name="img">
                </div>
                <img id="preview" src="{{asset($data->upload->path)}}" alt="Preview Gambar" style="max-width: 300px; margin-top: 10px; display: flex; margin-bottom: 12px;" />

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
        document.querySelector('input[name="img"]').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = "#";
            }
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
