<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('laporan_suplier.print') }}" target="_blank" class="btn btn-primary float-end">Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Suplier</th>
                        <th>Telpon</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
                        <th>Cabang</th>
                        <th>Kategori</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($suplier as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->telp }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td>{{ $s->keterangan }}</td>
                            <td>{{ $s->cabang->nama }}</td>
                            <td>{{ $s->kategori->kategori }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>



</x-app-layout>
