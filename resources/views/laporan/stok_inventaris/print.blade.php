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
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Barang</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Merek</th>
                            <th class="text-center">Serial Number</th>
                            <th class="text-center">Spesifikasi</th>
                            <th class="text-center">Tempat / Posisi</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $c)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->kode }}</td>
                                <td>{{ $c->nama_barang }}</td>
                                <td>{{ $c->kategori }}</td>
                                <td>{{ $c->merek }}</td>
                                <td>{{ $c->serial_number }}</td>
                                <td>{{ $c->spesifikasi }}</td>
                                <td>{{ $c->tempat_barang }}</td>
                                <td class="text-end">{{ $c->stok }}</td>
                                <td class="text-end">{{ number_format($c->harga_terbaru, 0) }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('product_image/' . $c->image) }}" alt="" width="80px">
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
