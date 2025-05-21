@extends('layout.main')

@section('title', 'Laporan')

@section('content')
    <div>
        <div class='mb-3'>
            <h2>Data Laporan {{$data->ibu->user->nama_lengkap}}</h2>
        </div>

        {{-- Detail Umum --}}
        <div class='row gap-2'>
            <div class='col-sm-6 mb-3'>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Detail Umum
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><span style='font-weight: bold;'>Nama Pendaftar : </span>{{$data->ibu->user->nama_lengkap}}</p>
                        <p><span style='font-weight: bold;'>Nama Anak : </span>{{$data->bayi->nama_lengkap != null ? $data->bayi->nama_lengkap : 'Pemeriksaanidak dengan anak'}}</p>
                        <p><span style='font-weight: bold;'>Jenis Pasien : </span>{{$data->jenis_pasien}}</p>
                        <p><span style='font-weight: bold;'>Tanggal Kunjungan </span>{{$data->pemeriksaan->tanggal_kunjungan}}</p>
                        <p><span style='font-weight: bold;'>Jam Kunjungan </span>{{$data->pemeriksaan->jam_kunjungan}}</p>
                        <p><span style='font-weight: bold;'>Kunjungan ke </span>{{$data->total_kunjungan}}</p>
                    </div>
                </div>
            </div>

            {{-- Detail Pemeriksaan --}}
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Pemeriksaan
                        </h5>
                    </div>
                    <div class="card-body">
                        <p><span style='font-weight: bold;'>Layanan yang dipilih : </span>{{$data->pemeriksaan->pelayanan->nama}}</p>
                        <p><span style='font-weight: bold;'>Jenis Layanan : </span>{{$data->pemeriksaan->pelayanan->jenis_layanan->nama}}</p>
                        <p><span style='font-weight: bold;'>Bidan yang melayani : </span>{{$data->pemeriksaan->bidan->user->nama_lengkap}}</p>
                        <p><span style='font-weight: bold;'>Harga Layanan : </span>Rp{{$data->pemeriksaan->harga}}</p>
                        <p><span style='font-weight: bold;'>Keluhan : </span>{{$data->pemeriksaan->pendaftaran->keluhan}}</p>
                    </div>
                </div>
            </div>

            <h3>Formulir</h3>

            @php
            // Ambil semua relasi form dari model pemeriksaan
            $forms = [
                'form_pelayanan_bayi' => 'Formulir Pelayanan Bayi',
                'form_pemeriksaan_umum' => 'Formulir Pemeriksaan Umum',
                // tambahkan relasi lainnya di sini
            ];
            @endphp

            @foreach ($forms as $relasi => $judul)
                @php
                    $form = $data->pemeriksaan->$relasi;
                @endphp

                @if ($form && $form->count() > 0)
                    @foreach ($form as $formulir)
                        <div class="col-sm-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ $judul }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kolom</th>
                                                <th>Isi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($formulir->getAttributes() as $key => $value)
                                            @continue(in_array($key, ['id', 'pemeriksaan_id', 'created_at', 'updated_at']))

                                            @php
                                                $label = ucwords(str_replace('_', ' ', str_replace('_id', '', $key)));
                                                $relasiName = \Str::camel(str_replace('_id', '', $key));
                                                $relasi = method_exists($formulir, $relasiName) ? $formulir->$relasiName : null;
                                            @endphp

                                            @if ($relasi && is_object($relasi))
                                                <tr>
                                                    <td>{{ $label }}</td>
                                                    <td>{{ $relasi->name ?? $relasi->nama ?? '-' }}</td>
                                                </tr>
                                                @if (isset($relasi->harga))
                                                <tr>
                                                    <td>Harga {{ $label }}</td>
                                                    <td>Rp{{ number_format($relasi->harga, 0, ',', '.') }}</td>
                                                </tr>
                                                @endif
                                            @else
                                                <tr>
                                                    <td>{{ $label }}</td>
                                                    <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach

        {{$data->pemeriksaan->form_pelayanan_bayi}}
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
