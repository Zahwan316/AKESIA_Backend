@extends('layout.main')

@section('title', 'Bidan Edit')

@section('content')
    <div class='mb-3'>
        <h2>Edit Data Bidan</h2>
    </div>
    <div class='w-50'>
        <form action="{{route('bidan.update', $data->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" class='form-control' name="nama_lengkap" id="" value={{$data->user->nama_lengkap}}>
            </div>
            <div class="form-group">
                <label for="">Provinsi</label>
                <select name="provinsi_id" id="provinsi-dropdown" class='form-control'>
                    <option >Pilih Provinsi</option>
                    @foreach ($provinsi as $prov)
                        <option value={{$prov->id}} {{ old('provinsi_id', $data->provinsi_id ?? '') == $prov->id ? 'selected' : '' }}>{{$prov->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Kota</label>
                <select name="kota_id" id="kota-dropdown" class='form-control'>
                    <option value="">Pilih Kota</option>

                </select>
            </div>
            <div class="form-group">
                <label for="">Status Keanggotaan Ibi</label>
                <select name="status_keanggotaan_ibi" id="kota-dropdown" class='form-control'>
                    <option value="" >Pilih Status Keanggotaan Ibi</option>
                    <option value="Aktif" {{ old('status_keanggotaan_ibi', $data->status_keanggotaan_ibi ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_keanggotaan_ibi', $data->status_keanggotaan_ibi ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">No STR</label>
                <input type="number" id='only-number' class='form-control' name="no_str" id="" value={{$data->no_STR}} {{old('no_STR', $data->no_STR)}}>
            </div>
            <div class="form-group">
                <label for="">No SIP</label>
                <input type="number" id='only-number' class='form-control' name="no_sip" id="" value={{$data->no_SIP}} {{old('no_SIP', $data->no_SIP)}}>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class='form-control' name="email" id="" value={{$data->user->email}} {{old('email', $data->user->email)}}>
            </div>
            <div class="form-group">
                <label for="">Ubah Password</label>
                <input type="password" class='form-control' name="password" id=""  {{old('password', $data->user->password)}}>
            </div>

            <x-button type='submit'>
                Ubah
            </x-button>
        </form>
    </div>

    <script>
        const kota_dropdown = document.getElementById('kota-dropdown');
        const provinsi = document.getElementById('provinsi-dropdown');
        const datakota = @json($kota);
        const selectedKotaId = "{{ old('kota_id', $data->kota_id ?? '') }}";

        document.getElementById('only-number').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // hanya angka
        });

        provinsi.addEventListener('change', () => {
            kota_dropdown.innerHTML = '<option value="">Pilih Kota</option>'
            datakota.forEach(element => {
                if(element.provinsi_id == provinsi.value){
                    const isSelected = element.id == selectedKotaId ? 'selected' : '';
                    kota_dropdown.innerHTML += `<option value="${element.id}" ${isSelected}>${element.name}</option>`
                }
            });
        })

        // Trigger saat load jika provinsi sudah terpilih
        if (provinsi.value) {
            provinsi.dispatchEvent(new Event('change'));
        }

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
