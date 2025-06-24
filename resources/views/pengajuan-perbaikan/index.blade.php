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
                        <th>Asset</th>
                        <th>Pemilik</th>
                        <th>Jumlah</th>
                        <th>Vendor</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perbaikan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->from == 'user' ? $p->karyawan->nama : 'Cabang :' . $p->cabang->nama }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->vendor->nama }}</td>
                            <td>Rp. {{ number_format($p->biaya, 0) }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td><span
                                    class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                            </td>
                            <td>
                                @if ($p->status == 'approved')
                                    @if ($p->status_perbaikan == 'repair')
                                        <button data-bs-toggle="modal" data-bs-target="#edit"
                                            data-id="{{ $p->id }}"
                                            class="btn btn-warning btn-sm getData">Selesaikan</button>
                                    @else
                                        <span
                                            class="badge {{ $p->status_perbaikan == 'finish' ? 'bg-success' : 'bg-danger' }}  ">{{ $p->status_perbaikan }}</span>
                                    @endif
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#edituser"
                                        data-id="{{ $p->id }}" class="btn btn-warning btn-sm geteditData"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <a href="{{ route('perbaikan.delete', $p->id) }}"
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

    <form action="{{ route('perbaikan.store') }}" method="post" class="submit">
        @csrf
        <x-modal id="tambah" size="modal-lg">
            <div class="row">
                {{-- <div class="col-lg-12">
                    <label for="">Barang dari</label>
                    <select name="from" id="pemilik" class="form-control">
                        <option value="">Pilih Barang dari</option>
                        <option value="cabang">Cabang</option>
                        <option value="user">Karyawan</option>
                    </select>
                </div> --}}
                {{-- user --}}
                <div class="col-lg-6 user mt-2">
                    <label for="">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control user">
                        <option value="">-Pilih Karyawan-</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Asset</label>
                    <select name="barang_id" id="barang_id" class="form-control user">

                    </select>
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Jumlah Peminjaman</label>
                    <input type="text" class="form-control qty">
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Jumlah Yang Diperbaiki</label>
                    <input type="number" class="form-control qty2 user" max="" name="jumlah">
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Vendor</label>
                    <select name="vendor_id" id="" class="form-control user">
                        <option value="">-Pilih Vendor-</option>
                        @foreach ($vendor as $v)
                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Harga Estimasi Perbaikan</label>
                    <input type="number" class="form-control user" name="biaya">
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Tanggal Estimasi Selesai</label>
                    <input type="date" class="form-control user" name="tgl_estimasi">
                </div>
                <div class="col-lg-6 user mt-2">
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control user" name="keterangan">
                </div>
                {{-- user --}}
                {{-- cabang --}}
                {{-- <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Asset</label>
                    <select name="barang_id" id="asset_id" class="form-control cabang" disabled>
                        <option value="">-Pilih Asset-</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} Merk : {{ $b->merek }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Stok</label>
                    <input type="text" class="form-control qty" disabled>
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Jumlah Yang Diperbaiki</label>
                    <input type="number" class="form-control qty2 cabang" max="" disabled name="jumlah">
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Vendor</label>
                    <select name="vendor_id" id="" class="form-control cabang" disabled>
                        <option value="">-Pilih Vendor-</option>
                        @foreach ($vendor as $v)
                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Harga Estimasi Perbaikan</label>
                    <input type="number" class="form-control cabang" disabled name="biaya">
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Tanggal Estimasi Selesai</label>
                    <input type="date" class="form-control cabang" disabled name="tgl_estimasi">
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control cabang" disabled name="keterangan">
                </div> --}}
            </div>
        </x-modal>
    </form>
    <form action="{{ route('perbaikan.selesai') }}" method="POST" class="submit">
        @csrf
        <x-modal-edit size="modal-md" id="edit" url="perbaikan.getPerbaikan" tipe='selesai'
            judul='Perbaikan Assets'>
        </x-modal-edit>
    </form>

    <form action="{{ route('perbaikan.update') }}" method="post" enctype="multipart/form-data" class="submit">
        @csrf
        <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Edit Permintaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change', '#pemilik', function(e) {
                    var pemilik = $(this).val()
                    if (pemilik == 'user') {
                        $('.user').attr('hidden', false);
                        $('.user').attr('disabled', false);
                        $('.cabang').attr('hidden', true);
                        $('.cabang').attr('disabled', true);
                    } else {
                        $('.cabang').attr('hidden', false);
                        $('.cabang').attr('disabled', false);
                        $('.user').attr('hidden', true);
                        $('.user').attr('disabled', true);
                    }

                });
                $(document).on('change', '#karyawan_id', function(e) {

                    var karyawan_id = $(this).val();

                    $.ajax({
                        type: "get",
                        url: "/perbaikan/getAssetKaryawan",
                        data: {
                            karyawan_id: karyawan_id
                        },
                        success: function(response) {
                            $('#barang_id').html(response);
                        }
                    });

                });
                $(document).on('change', '#asset_id', function(e) {

                    var barang_id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "/perbaikan/getStockCabang",
                        data: {
                            barang_id: barang_id
                        },
                        success: function(response) {
                            $('.qty').val(response);
                            $('.qty2').attr('max', response);
                        }
                    });

                });
                $(document).on('change', '#barang_id', function(e) {

                    var invoice = $(this).val();

                    $.ajax({
                        type: "get",
                        url: "/perbaikan/getQtyAssetKaryawan",
                        data: {
                            invoice: invoice
                        },
                        success: function(response) {
                            $('.qty').val(response);
                            $('.qty2').attr('max', response);
                        }
                    });

                });
                $(document).on('change', '.status', function(e) {
                    var status = $(this).val()
                    if (status == 'finish') {
                        $('.finish').attr('hidden', false);
                        $('.detail_finish').attr('disabled', false);
                    } else {
                        $('.crash').attr('hidden', false);
                        $('.detail_crash').attr('disabled', false);
                    }


                });

                $(document).on('click', '.getData', function(e) {
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: "/perbaikan/getPerbaikan",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $(".load-data").html(data);

                        }
                    });
                });

                $(document).on('click', '.geteditData', function(e) {
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "/perbaikan/getEdit",
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
