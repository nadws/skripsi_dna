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
                                <button data-bs-toggle="modal" data-bs-target="#edit"
                                    class="btn btn-warning btn-sm getData" data-id="{{ $k->id }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('kategori.delete', $k->id) }}"
                                    onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                        class="bi bi-trash"></i></a>
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
    <form action="{{ route('kategori.update') }}" method="post">
        @csrf
        <x-modal-edit id="edit" size="modal-lg" judul="Edit Kategori" url="/kategori/getEdit"></x-modal-edit>
    </form>
    @section('js')
    @endsection
</x-app-layout>
