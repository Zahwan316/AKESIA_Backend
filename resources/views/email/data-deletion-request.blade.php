@component('mail::message')
# Permintaan Penghapusan Data

Anda menerima email ini karena ada permintaan penghapusan data untuk akun Akesia yang terkait dengan alamat email ini.

**Email:** {{ $email }}
@if($reason)
**Alasan:** {{ $reason }}
@endif

@component('mail::button', ['url' => $verification_url, 'color' => 'error'])
Verifikasi Penghapusan Data
@endcomponent

Link verifikasi akan kadaluarsa dalam 24 jam. Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini atau hubungi tim dukungan kami.

Terima kasih,
Tim Akesia
@endcomponent
