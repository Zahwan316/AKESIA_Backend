<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Penghapusan Data - Akesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-soft-akesia">
                        <h4 class="mb-0 text-akesia">Verifikasi Penghapusan Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <h5><i class="bi bi-exclamation-triangle-fill"></i> Peringatan!</h5>
                            <p class="mb-0">Anda akan menghapus semua data Anda di Akesia secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                        </div>

                        <div class="mb-4">
                            <p>Email: <strong>{{ $request->email }}</strong></p>
                            @if($request->reason)
                            <p>Alasan: {{ $request->reason }}</p>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('data-deletion.process') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->token }}">

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="finalConfirmation" name="final_confirmation" required>
                                <label class="form-check-label" for="finalConfirmation">Saya mengerti bahwa semua data saya akan dihapus secara permanen dan tidak dapat dikembalikan</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="bi bi-trash-fill"></i> Hapus Data Saya Secara Permanen
                                </button>
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Batalkan
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
