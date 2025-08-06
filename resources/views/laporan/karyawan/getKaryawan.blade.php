<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Cabang</th>
            <th>Departemen</th>
            <th>Tempat/tanggal lahir</th>
            <th>Jenis kelamin</th>
            <th>Tanggal Bergabung</th>
            <th>Alamat</th>
            <th class="text-center">Foto</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($karyawan as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->nama }}</td>
                <td>{{ $c->jabatan }}</td>
                <td>{{ $c->cabang->nama }}</td>
                <td>{{ $c->departemen->nama }}</td>
                <td>{{ $c->tempat_lahir }}, {{ date('d-m-Y', strtotime($c->tgl_lahir)) }}</td>
                <td>{{ $c->jenis_kelamin }}</td>
                <td>{{ date('d-m-Y', strtotime($c->tgl_gabung)) }}</td>
                <td>{{ $c->alamat }}</td>
                <td class="text-center">
                    <img src="{{ asset('karyawan_image/' . $c->foto) }}" alt="" width="80px" height="80px">
                </td>

            </tr>
        @endforeach
    </tbody>

</table>
