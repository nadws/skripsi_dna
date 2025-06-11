<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('laporan_cabang.print') }}" target="_blank" class="btn btn-primary float-end">Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cabang</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->nama }}</td>
                            <td>{{ $c->alamat }}</td>
                            <td>{{ $c->ket }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>



</x-app-layout>
