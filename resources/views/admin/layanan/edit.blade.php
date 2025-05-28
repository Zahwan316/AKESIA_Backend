@extends('layout.main')

@section('title', 'Edit Layanan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>
                Edit Layanan
            </h2>

        </div>
        <div class='w-50'>
            <form action="{{route('layanan.update', $data->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Nama Layanan</label>
                    <input type="text" class="form-control" name="nama" value='{{$data->nama}}'>
                </div>
                <div class="form-group">
                    <label>Jenis Layanan</label>
                    <select class="form-control" name='jenis_layanan_id'>
                        <option value=''>Pilih Jenis Layanan</option>
                        @foreach ($jenis_layanan as $item)
                            <option value='{{$item->id}}' {{ old('jenis_layanan_id', $data->jenis_layanan_id ?? '') == $item->id ? 'selected' : '' }}>{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div>
                        <label>Harga Layanan</label>
                    </div>
                    <div class='input-group'>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio-harga" id="radio-harga">
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control input-harga" id='only-number' name="harga" value={{$data->harga}}>
                    </div>
                    <span>Atau</span>
                    <div class='input-group'>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio-harga" id="radio-admin">
                        </div>
                        <input type="text" class="form-control input-admin" id='only-number' name="harga_admin" value='CHAT ADMIN' readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class='form-control' style="text-align: left; padding-top: 0.5rem;resize: none;" rows="5" name='keterangan'>{{$data->keterangan}}</textarea>
                </div>
                <div class="form-group">
                    <label>Formulir</label>
                    <select class='form-control' name="formulir_id">
                        <option>Pilih Formulir</option>
                        @foreach ($ref_jenis_form as $formulir)
                            <option value='{{$formulir->id}}' {{ old('formulir_id', $selected_formulir) == $formulir->id ? 'selected' : '' }}>
                                {{$formulir->name}}
                            </option>
                        @endforeach
                        <option value='formulir_periksa_hamil' {{ old('formulir_id', $selected_formulir) == 'multiple' ? 'selected' : '' }}>
                            Formulir Bersalin + Nifas + Bayi + Lainnya
                        </option>
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
        const radio_harga = document.getElementById('radio-harga')
        const radio_admin = document.getElementById('radio-admin')
        const input_harga = document.getElementsByClassName('input-harga')[0]
        const input_admin = document.getElementsByClassName('input-admin')[0]


        function toggleInput() {
            if (radio_harga.checked) {
                input_harga.disabled = false;
                //input_admin.disabled = true;
            } else if (radio_admin.checked) {
                input_harga.disabled = true;
                //input_admin.disabled = false;
            }
        }

        radio_harga.addEventListener('change', toggleInput);
        radio_admin.addEventListener('change', toggleInput);

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
