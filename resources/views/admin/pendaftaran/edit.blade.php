@extends('layout.main')

@section('title', 'Pendaftaran Edit')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Detail Pendaftar</h2>
        </div>

        <div>
            <div class="card">
                <div class="card-body">
                    <form id='form' action="{{route('pendaftaran.update', $data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class='form-group'>
                            <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Nama Pendaftar</h4>
                            <p>{{$data->ibu->user->nama_lengkap}}</p>
                        </div>
                        <div class='form-group'>
                            <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Nomor Telepon</h4>
                            <p>{{$data->ibu->telepon}}</p>
                        </div>
                        <div class='form-group'>
                            <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Layanan yang dipilih</h4>
                            <p>{{$data->pelayanan->nama}}</p>
                        </div>
                        <div class='form-group'>
                            <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Keluhan</h4>
                            <p>{{$data->keluhan}}</p>
                        </div>
                        <div class='form-group'>
                            <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Status</h4>
                            <select class='form-control' name='status' id='form-status'>
                                <option value=''>Tentukan Status</option>
                                <option value='Disetujui'>Disetujui</option>
                                <option value='Dibatalkan'>Dibatalkan</option>
                            </select>
                        </div>
                        <div id='disetujui-container' style='display: none;'>
                            <div class='form-group'>
                                <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Tentukan Jam</h4>
                                <input type="time"  name="jam_ditentukan" class="form-control" placeholder="00:00">
                            </div>
                            <div class='form-group'>
                                <h4 class='fw-bold' style='font-weight: bold; font-size: 20'>Bidan yang melayani</h4>
                                <select class='form-control' name='bidan_id'>
                                    <option value=''>Pilih Bidan</option>
                                    @foreach ($bidan as $data_bidan )
                                        <option value='{{$data_bidan->id}}'>{{$data_bidan->user->nama_lengkap}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button id='btn-submit' type='button' class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const disetujuiContainer = document.getElementById('disetujui-container');
        const formStatus = document.getElementById('form-status')
        const form = document.getElementById('form');
        const submitBtn = document.getElementById('btn-submit');

        formStatus.addEventListener('change', () => {
            if(formStatus.value === 'Disetujui'){
                disetujuiContainer.style.display = 'block'
            }
            else{
                disetujuiContainer.style.display = 'none'
            }
        })

        submitBtn.addEventListener('click', function (e) {
            Swal.fire({
                title: 'Yakin ingin update data?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
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
