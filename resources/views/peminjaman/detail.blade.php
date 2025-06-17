<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <h4 class="text-center mt-4">PT SABA INDOMEDIKA</h4>
    <h5 class="text-center mt-2">JL Buncit Indah II No.54 Pemurus Baru, Kec,</h5>
    <h5 class="text-center mt-2">Banjarmasin Sel, Kota Banjarmasin</h5>
    <div class="col-lg-12">
        <hr style="border: 1px solid black; ">
    </div>
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Invoice</th>
                        <th width="2%"> : </th>
                        <th>{{ $peminjaman->invoice }}</th>
                    </tr>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th width="2%"> : </th>
                        <th>{{ $peminjaman->karyawan->nama }}</th>
                    </tr>
                    <tr>
                        <th>Cabang</th>
                        <th width="2%"> : </th>
                        <th>
                            {{ $peminjaman->cabang->nama }}
                        </th>
                    </tr>
                    <tr>
                        <th>Barang</th>
                        <th width="2%"> : </th>
                        <th>
                            {{ $peminjaman->barang->nama_barang }}
                        </th>
                    </tr>
                    <tr>
                        <th>Qty</th>
                        <th width="2%"> : </th>
                        <th>
                            {{ $peminjaman->qty }}
                        </th>
                    </tr>
                    <tr>
                        <th>Ket</th>
                        <th width="2%"> : </th>
                        <th>
                            {{ $peminjaman->ket }}
                        </th>
                    </tr>
                    <tr>
                        <th>status</th>
                        <th width="2%"> : </th>
                        <th>
                            <span
                                class="badge {{ $peminjaman->status == 'pending' ? 'bg-warning' : ($peminjaman->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $peminjaman->status }}</span>
                        </th>
                    </tr>
                    @if ($peminjaman->status == 'rejected')
                        <tr>
                            <th>Alasan Penolakan</th>
                            <th width="2%"> : </th>
                            <th>
                                {{ $peminjaman->ket_presiden }}
                            </th>
                        </tr>
                    @endif
                    <tr>
                        <th colspan="3">
                            <image src="{{ asset('peminjaman_image/' . $peminjaman->file) }}" width="50%"
                                height="50%" alt="">
                        </th>
                    </tr>


                </table>

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

</body>

</html>
