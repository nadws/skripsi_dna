<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @if ($role == 'admin')
                <h5 class="float-start">Stok Barang Cabang : {{ $nama_cabang }}</h5>
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                    Data</button>
            @else
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Barang</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Merek</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barang as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->kode }}</td>
                            <td>{{ $c->nama_barang }}</td>
                            <td>{{ $c->merek }}</td>
                            <td class="text-end">{{ $c->stok }}</td>
                            <td class="text-end">{{ number_format($c->harga_terbaru, 0) }}</td>
                            <td class="text-center">
                                <img src="{{ asset('product_image/' . $c->image) }}" alt="" width="80px">
                            </td>
                            <td class="text-center">
                                @if ($role == 'presiden')
                                    <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                @else
                                    <a href="#" class="btn btn-warning btn-sm"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="#" onclick="return confirm('Apakah anda yakin?')"
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-modal size="modal-xl" id="tambah">
            <div class="row">
                <div class="col-lg-4">
                    <img id="imagePreview" src="./product_image/image.png" alt="Preview Gambar"
                        style="max-width: 150px;">
                    <br>
                    <input type="file" class="form-control" name="image" id="imageInput">
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" value="{{ $kode_barang }}"
                                disabled>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang">
                            <input type="hidden" class="form-control" name="cabang_id" value="{{ $cabang_id }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Merek</label>
                            <input type="text" class="form-control" name="merek">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Stok Awal</label>
                            <input type="text" class="form-control" name="stok_awal">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Harga Satuan Beli</label>
                            <input type="text" class="form-control" name="harga">
                        </div>

                    </div>

                </div>

            </div>

        </x-modal>
    </form>

</x-app-layout>
