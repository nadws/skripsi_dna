<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('laporan_vendor.print') }}" target="_blank" class="btn btn-primary float-end">Print</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Vendor</th>
                        <th>No telpon</th>
                        <th>Alamat</th>
                        <th>Cabang</th>
                        <th>Kategori</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendor as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->telepon }}</td>
                            <td>{{ $v->alamat }}</td>
                            <td>{{ $v->cabang->nama }}</td>
                            <td>{{ $v->kategori->kategori }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>



</x-app-layout>
