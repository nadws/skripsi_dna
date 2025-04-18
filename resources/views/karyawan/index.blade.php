<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end">Tambah
                Data</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Cabang</th>
                        <th>Departemen</th>
                        <th>Tempat/tanggal lahir</th>
                        <th>Jenis kelamin</th>
                        <th>Tanggal Bergabung</th>
                        <th>Alamat</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->nama }}</td>
                            <td>{{ $c->cabang->nama }}</td>
                            <td>{{ $c->departemen->nama }}</td>
                            <td>{{ $c->tempat_lahir }}, {{ date('d-m-Y', strtotime($c->tgl_lahir)) }}</td>
                            <td>{{ $c->jenis_kelamin }}</td>
                            <td>{{ date('d-m-Y', strtotime($c->tgl_gabung)) }}</td>
                            <td>{{ $c->alamat }}</td>
                            <td class="text-center">
                                <img src="{{ asset('karyawan_image/' . $c->foto) }}" alt="" width="80px"
                                    height="80px">
                            </td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('cabang.delete', $c->id) }}"
                                    onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('karyawan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-modal size="modal-lg" id="tambah">
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
                            <label for="">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama">
                            <input type="hidden" name="cabang_id" value="{{ $cabang_id }}">
                        </div>

                        <div class="col-lg-6 mt-2">
                            <label for="">Departemen</label>
                            <select name="departemen_id" id="" class="form-control">
                                <option value="">Pilih Departemen</option>
                                @foreach ($departemen as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="">Tanggal Bergabung</label>
                            <input type="date" class="form-control" name="tgl_gabung">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="" cols="10" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

            </div>

        </x-modal>
    </form>
</x-app-layout>
