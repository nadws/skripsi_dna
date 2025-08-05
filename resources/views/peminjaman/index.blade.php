<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @if ($role == 'admin')
                <a href="{{ route('peminjaman.formulir') }}" target="_blank" class="btn btn-primary float-end ms-2"><i
                        class="bi bi-printer"></i> Print Formulir</a>
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end">Tambah
                    Data</button>
            @else
            @endif

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Peminjaman</th>
                        <th>Nama Karyawan</th>
                        <th>Cabang</th>
                        <th>Tanggal pinjam</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Ket</th>
                        <th>status</th>
                        <th>Qr Code</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->invoice }}</td>
                            <td>{{ $p->karyawan->nama }}</td>
                            <td>{{ $p->cabang->nama }}</td>
                            <td>{{ date('d/m/Y', strtotime($p->tgl_pinjam)) }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ $p->ket }}</td>
                            <td><span
                                    class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                            </td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detail" class="getQr"
                                    data-id="{{ $p->id }}">
                                    {!! QrCode::size(80)->generate(url("/peminjaman/getDataPeminjaman?id=$p->id")) !!}
                                </a>
                            </td>

                            <td>

                                @if ($role == 'manager')
                                    @if ($p->status == 'approved')
                                        <span class="badge bg-success"><i class="bi bi-check2-all"></i></span>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#edit"
                                            data-id="{{ $p->id }}" class="btn btn-info btn-sm getData"><i
                                                class="bi bi-search"></i></button>
                                    @endif
                                @else
                                    @if ($p->status == 'approved')
                                        <button data-bs-toggle="modal" data-bs-target="#view"
                                            data-id="{{ $p->id }}" class="btn btn-primary btn-sm getData"><i
                                                class="bi bi-eye-fill"></i></button>
                                        <button data-bs-toggle="modal" data-bs-target="#edituser"
                                            data-id="{{ $p->id }}" class="btn btn-warning btn-sm geteditData"><i
                                                class="bi bi-pencil-square"></i></button>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#view"
                                            data-id="{{ $p->id }}" class="btn btn-primary btn-sm getData"><i
                                                class="bi bi-eye-fill"></i></button>
                                        <button data-bs-toggle="modal" data-bs-target="#edituser"
                                            data-id="{{ $p->id }}" class="btn btn-warning btn-sm geteditData"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <a href="{{ route('peminjaman.delete', $p->id) }}"
                                            onclick="return confirm('Apakah anda yakin?')"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('peminjaman.store') }}" method="post" enctype="multipart/form-data" class="submit">
        @csrf
        <x-modal size="modal-lg" id="tambah">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama Karyawan</label>
                    <select name="karyawan_id" id="" class="form-control">
                        <option value="">Pilih Karyawan</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Barang</label>
                    <select name="barang_id" id="" class="form-control">
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} ( {{ $b->merek }} )
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Tanggal Peminjaman</label>
                    <input type="date" class="form-control" name="tgl_pinjam">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Qty</label>
                    <input type="number" class="form-control" name="qty">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Ket</label>
                    <input type="text" class="form-control" name="ket">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Lampirkan Formulir </label>
                    <input type="file" class="form-control" name="file">
                </div>


            </div>

        </x-modal>
    </form>
    <form action="{{ route('peminjaman.accepted') }}" method="POST" class="submit">
        @csrf
        <x-modal-edit size="modal-lg" id="edit" url="/peminjaman/getDataPeminjaman" tipe='edit'
            judul='Peminjaman Assets'>
        </x-modal-edit>
    </form>


    <x-modal-edit size="modal-lg" id="view" url="/peminjaman/getDataPeminjaman" tipe='acc'
        judul='Peminjaman Assets'>
    </x-modal-edit>
    <x-modal-edit size="modal-lg" id="view" url="/peminjaman/getDataPeminjaman" tipe='acc'
        judul='Peminjaman Assets'>
    </x-modal-edit>

    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Qr</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="load-qr"></div>
                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('peminjaman.update') }}" method="post" enctype="multipart/form-data" class="submit">
        @csrf
        <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div id="load-edit_data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit_btn">Simpan</button>
                        <button type="button" disabled class="btn btn-primary submit_proses" hidden>Proses
                            ..</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('scripts2')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.getQr', function(e) {
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "/peminjaman/getQr",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {

                            $("#load-qr").html(data);

                        }
                    });
                });
                $(document).on('click', '.geteditData', function(e) {
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "/peminjaman/getDataEditPeminjaman",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {

                            $("#load-edit_data").html(data);

                        }
                    });
                });
            });
        </script>
    @endsection













</x-app-layout>
