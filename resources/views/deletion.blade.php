<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Penghapusan Data - Akesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <span class="text-akesia">Akesia</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Kembali ke Beranda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Data Deletion Request Content -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="fw-bold text-akesia mb-3">Permintaan Penghapusan Data</h1>
                        <p class="lead">Anda dapat mengajukan permintaan penghapusan data pribadi Anda dari sistem kami</p>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-lg-5">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('data-deletion.submit') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Alamat Email Terdaftar</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email yang terdaftar di Akesia">
                                </div>

                                <div class="mb-4">
                                    <label for="reason" class="form-label fw-bold">Alasan Penghapusan Data (Opsional)</label>
                                    <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Berikan alasan Anda meminta penghapusan data"></textarea>
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="confirmation" name="confirmation" required>
                                    <label class="form-check-label" for="confirmation">Saya memahami bahwa penghapusan data bersifat permanen dan tidak dapat dikembalikan</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-akesia btn-lg">
                                        <i class="bi bi-trash-fill me-2"></i> Ajukan Permintaan Penghapusan
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="alert alert-info">
                                <h5 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Proses Penghapusan Data</h5>
                                <p class="mb-0">Setelah Anda mengirimkan permintaan, kami akan memverifikasi identitas Anda melalui email. Proses penghapusan data akan dilakukan dalam waktu maksimal 30 hari kerja setelah verifikasi berhasil.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 small">&copy; 2023 Akesia. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 small">Dibuat dengan <i class="bi bi-heart-fill text-akesia"></i> untuk kesehatan ibu dan anak</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}'
            });
        </script>
    @endif

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
    @endif;
</body>
</html>
