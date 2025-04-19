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
        <h5 class="text-center mt-2">Permohonan Peminjaman Asset Karyawan</h5>
    </div>
    <div class="container-fluid">
        <div class="row">
            <style>
                th {
                    padding: 10px
                }
            </style>
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>:</th>
                        <th>______________________________________</th>
                    </tr>
                    <tr>
                        <th>Cabang</th>
                        <th>:</th>
                        <th>{{ $cabang->nama }}</th>
                    </tr>
                    <tr>
                        <th>Asset Yang Dipinjam</th>
                        <th>:</th>
                        <th>______________________________________</th>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>:</th>
                        <th>______________________________________</th>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <th>:</th>
                        <th>______________________________________</th>
                    </tr>
                </table>


            </div>

            <div class="col-8"></div>
            <div class="col-4">
                <br>
                <br>
                <br>
                <p class="text-center">Banjarmasin, {{ date('d-m-Y') }}</p>
                <p class="text-center">Pemohon</p>
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
