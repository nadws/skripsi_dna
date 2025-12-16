<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Tanda Tangan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
        }

        .verify-card {
            max-width: 420px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="card shadow verify-card text-center p-4">
        <h3 class="mb-3">Verifikasi Tanda Tangan Digital</h3>

        <p class="mb-1 text-start">Nama : <strong>{{ $pegawai->name }}</strong></p>
        <p class="mb-1 text-start">Divisi : {{ $pegawai->role }}</p>
        {{-- <p class="mb-3 text-muted text-start">Posisi : {{ $pegawai->divisi->divisi }}</p> --}}

        <span class="badge bg-success fs-6 py-2 px-3">✅ Valid</span>

        <hr class="my-4">

        <small class="text-muted">Dokumen ini ditandatangani secara digital dan tersimpan dalam sistem.</small>
    </div>

</body>

</html>
