<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('stok_inventaris.print', ['cabang' => Auth::user()->cabang_id]) }}" target="_blank"
                class="btn btn-warning float-end ms-2">Print</a>
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                Data</button>
        </div>
        <div class="card-body">
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
                        <th class="text-center">Stok</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Tempat / Posisi</th>
                        {{-- <th class="text-center">Foto</th> --}}
                        <th class="text-center">Aksi</th>
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
                            <td class="text-end">{{ $c->stok }}</td>
                            <td class="text-end">{{ number_format($c->harga_terbaru, 0) }}</td>
                            <td class="text-end">{{ $c->tempat_barang }}</td>
                            {{-- <td class="text-center">
                                <img src="{{ asset('product_image/' . $c->image) }}" alt="" width="80px"
                                    height="80px">
                            </td> --}}
                            <td class="text-center">
                                @if ($role == 'presiden')
                                    <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#edit"
                                        class="btn btn-warning btn-sm getData" data-id="{{ $c->id }}"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <a href="{{ route('barang.delete', $c->id) }}"
                                        onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data" class="submit">
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

                        </div>
                        <div class="col-lg-6">
                            <label for="">Kategori</label>
                            <select name="kategori_id" id="" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $c)
                                    <option value="{{ $c->id }}">{{ $c->kategori }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg-6">
                            <label for="">Merek</label>
                            <input type="text" class="form-control" name="merek">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Serial Number</label>
                            <input type="text" class="form-control" name="serial_number">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Spesifikasi</label>
                            <input type="text" class="form-control" name="spesifikasi">
                        </div>
                        <div class="col-lg-12">
                            <label for="">Tempat/Posisi</label>
                            <input type="text" class="form-control" name="tempat_barang">
                        </div>
                        @if ($role == 'admin')
                            <input type="hidden" class="form-control" name="cabang_id" value="{{ $cabang_id }}">
                        @elseif ($role == 'superadmin')
                            <div class="col-lg-6">
                                <label for="">Cabang</label>
                                <select name="cabang_id" id="" class="form-control">
                                    <option value="">Pilih Cabang</option>
                                    @foreach ($cabang as $c)
                                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        {{-- <div class="col-lg-6">
                            <label for="">Stok Awal</label>
                            <input type="text" class="form-control" name="stok_awal">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Harga Satuan Beli</label>
                            <input type="text" class="form-control" name="harga">
                        </div> --}}

                    </div>

                </div>

            </div>

        </x-modal>
    </form>

    <form action="{{ route('barang.update') }}" method="post" enctype="multipart/form-data" class="submit">
        @csrf
        <x-modal-edit id="edit" size="modal-lg" judul="Edit Barang" url="/barang/getEdit"></x-modal-edit>
    </form>

</x-app-layout>
