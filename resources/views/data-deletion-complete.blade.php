<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghapusan Data Selesai - Akesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="mb-3">Penghapusan Data Berhasil</h2>
                        <p class="lead mb-4">Semua data Anda telah dihapus secara permanen dari sistem kami.</p>
                        <p>Terima kasih telah menggunakan Akesia. Jika Anda ingin menggunakan layanan kami lagi di masa depan, Anda perlu mendaftar akun baru.</p>
                        <a href="{{ url('/') }}" class="btn btn-akesia mt-3">
                            <i class="bi bi-house-door"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
