<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori_asset as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->kategori }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" onclick="return confirm('Apakah anda yakin?')"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ route('kategori.store') }}" method="post">
        @csrf
        <x-modal id="tambah">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Kategori Asset</label>
                    <input type="text" class="form-control" name="kategori">

                </div>
            </div>
        </x-modal>
    </form>
    @section('js')
    @endsection
</x-app-layout>
