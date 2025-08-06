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
            <div class="col-lg-12">
                <h5 class="text-center fw-bold text-decoration-underline">{{ $title }}</h5>

            </div>
            <div class="col-lg-4">
                <p>Cabang : {{ $cabang->nama }}</p>
            </div>
            <div class="col-12">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Nama Karyawan</th>
                            <th>Cabang</th>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Ket</th>
                            <th>status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $no => $p)
                            @php
                                $disposal = DB::table('disposals')->where('invoice_peminjaman', $p->invoice)->first();

                                if (!empty($disposal->barang_id)) {
                                    continue;
                                }
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->invoice }}</td>
                                <td>{{ $p->karyawan->nama }}</td>
                                <td>{{ $p->cabang->nama }}</td>
                                <td>{{ $p->barang->nama_barang }}</td>
                                <td>{{ $p->qty }}</td>
                                <td>{{ $p->ket }}</td>
                                <td><span
                                        class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  "></span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-8"></div>
            <div class="col-4">
                <p class="text-center">Banjarmasin, {{ date('d-m-Y') }}</p>
                <p class="text-center">Mengetahui</p>
                <br><br>
                <p class="text-center">..................</p>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <script>
        window.print();
    </script>
</body>

</html>
