<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akesia - Aplikasi Kesehatan Ibu dan Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <span class="text-akesia">Akesia</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimoni">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#download">Download</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('privacy')}}">Kebijakan dan Privasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section py-5">
        <div class="container py-5">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Pantau Kesehatan Ibu dan Anak dengan Mudah</h1>
                    <p class="lead mb-4">Akesia membantu Anda memonitor perkembangan kehamilan dan pertumbuhan anak secara praktis dari rumah.</p>
                    <a href="#download" class="btn btn-akesia btn-lg px-4">Download Sekarang</a>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('img/LogoBidanBunda.png') }}" alt="Ibu dan Anak" class="img-fluid rounded-3 ">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="fw-bold mb-3">Tentang Akesia</h2>
                    <div class="divider mx-auto bg-akesia"></div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/bunda.png') }}" alt="Tentang Akesia" class="img-fluid rounded-3">
                </div>
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-4">Mempermudah Pemantauan Kesehatan Ibu dan Anak</h3>
                    <p>Akesia hadir sebagai solusi digital untuk membantu para ibu hamil dan orang tua dalam memantau kesehatan dan perkembangan anak secara mandiri dari rumah.</p>
                    <p>Dengan fitur-fitur yang mudah digunakan, Akesia membantu Anda mencatat perkembangan kehamilan, jadwal imunisasi, pertumbuhan anak, dan memberikan informasi kesehatan yang terpercaya.</p>
                    <div class="d-flex align-items-center mt-4">
                        <div class="feature-icon rounded-circle bg-soft-akesia me-3">
                            <i class="bi bi-heart-pulse text-akesia"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Pantau Kesehatan</h5>
                            <p class="mb-0 small">Catat perkembangan kehamilan dan pertumbuhan anak</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <div class="feature-icon rounded-circle bg-soft-akesia me-3">
                            <i class="bi bi-bell text-akesia"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Pengingat</h5>
                            <p class="mb-0 small">Notifikasi jadwal pemeriksaan dan imunisasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="fw-bold mb-3">Apa Kata Pengguna?</h2>
                    <div class="divider mx-auto bg-akesia"></div>
                    <p class="mt-3">Testimoni dari ibu-ibu yang telah menggunakan Akesia</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="mb-4">"Sejak menggunakan Akesia, saya jadi lebih tenang memantau kehamilan. Fitur pencatatan perkembangan janin sangat membantu!"</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/user1.jpg') }}" alt="User" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0">Sarah Wijaya</h6>
                                    <small class="text-muted">Ibu Hamil 7 Bulan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <p class="mb-4">"Aplikasi ini sangat membantu saya mengingat jadwal imunisasi anak. Tidak perlu lagi buka buku catatan setiap saat."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/user2.jpg') }}" alt="User" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0">Dina Permata</h6>
                                    <small class="text-muted">Ibu dari Balita</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3 text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="mb-4">"Informasi kesehatan yang disediakan sangat lengkap dan mudah dipahami. Sangat bermanfaat untuk ibu baru seperti saya."</p>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/user3.jpg') }}" alt="User" class="rounded-circle me-3" width="50">
                                <div>
                                    <h6 class="mb-0">Rina Setiawan</h6>
                                    <small class="text-muted">Ibu Menyusui</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="download" class="py-5 bg-soft-akesia">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Download Aplikasi Akesia Sekarang</h2>
                    <p class="lead mb-5">Mulai pantau kesehatan ibu dan anak dengan lebih mudah melalui smartphone Anda.</p>
                    <a href="https://play.google.com/store/apps" target="_blank" class="btn btn-akesia btn-lg px-4">
                        <i class="bi bi-google-play me-2"></i> Download di Play Store
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h4 class="text-akesia fw-bold mb-4">Akesia</h4>
                    <p>Aplikasi Kesehatan Ibu dan Anak yang membantu memantau perkembangan kehamilan dan pertumbuhan anak secara praktis.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-white text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="#about" class="text-white text-decoration-none">Tentang</a></li>
                        <li class="mb-2"><a href="#testimoni" class="text-white text-decoration-none">Testimoni</a></li>
                        <li class="mb-2"><a href="#download" class="text-white text-decoration-none">Download</a></li>
                        <li class="mb-2"><a href="/data-deletion" class="text-white text-decoration-none">Hapus Data Saya</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-envelope me-2 text-akesia"></i> workshoppolije1@gmail.com</li>
                        {{-- <li class="mb-2"><i class="bi bi-telephone me-2 text-akesia"></i> +62 123 4567 890</li> --}}
                        <li class="mb-2"><i class="bi bi-geo-alt me-2 text-akesia"></i> Jember, Indonesia</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    {{-- <h5 class="mb-4">Sosial Media</h5>
                    <div class="d-flex">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube fs-5"></i></a>
                    </div> --}}
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 small">&copy; 2025 Akesia. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 small">Made with <i class="bi bi-heart-fill text-akesia"></i> for healthier mothers and children</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
