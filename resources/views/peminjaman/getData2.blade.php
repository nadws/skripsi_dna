<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Peminjaman</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* bisa jadi center kalau mau tengah vertikal juga */
            min-height: 100vh;
            padding-top: 50px;
        }

        .table {
            border-collapse: collapse;
            width: auto;
        }

        .table th,
        .table td {
            padding: 8px 16px;
            text-align: left;
        }
    </style>

</head>

<body>
    <div class="justify-content-center">
        <table class="table">
            <tr>
                <th>Kode Peminjaman</th>
                <th> : </th>
                <th>{{ $peminjaman->invoice }}</th>
            </tr>
            <tr>
                <th>Nama Karyawan</th>
                <th> : </th>
                <th>{{ $peminjaman->karyawan->nama }}</th>
            </tr>
            <tr>
                <th>Cabang</th>
                <th> : </th>
                <th>
                    {{ $peminjaman->cabang->nama }}
                </th>
            </tr>
            <tr>
                <th>Barang</th>
                <th> : </th>
                <th>
                    {{ $peminjaman->barang->nama_barang }}
                </th>
            </tr>
            <tr>
                <th>Tanggal Peminjaman</th>
                <th> : </th>
                <th>
                    {{ $peminjaman->tgl_pinjam }}
                </th>
            </tr>
            <tr>
                <th>Qty</th>
                <th> : </th>
                <th>
                    {{ $peminjaman->qty - $peminjaman->qty_disposal - $peminjaman->qty_pengembalian }}
                </th>
            </tr>
            <tr>
                <th>Ket</th>
                <th> : </th>
                <th>
                    {{ $peminjaman->ket }}
                </th>
            </tr>
            <tr>
                <th>status</th>
                <th> : </th>
                <th>
                    <span
                        class="badge {{ $peminjaman->status == 'pending' ? 'bg-warning' : ($peminjaman->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $peminjaman->status }}</span>
                </th>
            </tr>
            @if ($peminjaman->status == 'rejected')
                <tr>
                    <th>Alasan Penolakan</th>
                    <th> : </th>
                    <th>
                        {{ $peminjaman->ket_presiden }}
                    </th>
                </tr>
            @endif
            <tr>
                <th colspan="3">
                    <image src="{{ asset('peminjaman_image/' . $peminjaman->file) }}" width="100%" height="100%"
                        alt="">
                </th>
            </tr>

            <input type="hidden" name="id" value="{{ $peminjaman->id }}">
            <input type="hidden" name="invoice" value="{{ $peminjaman->invoice }}">
            <input type="hidden" name="barang_id" value="{{ $peminjaman->barang_id }}">
            <input type="hidden" name="cabang_id" value="{{ $peminjaman->cabang_id }}">


        </table>
    </div>

</body>

</html>
