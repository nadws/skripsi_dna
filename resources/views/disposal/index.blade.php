<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <a target="_blank" href="{{ route('laporan_disposal.print', ['cabang' => $cabang_id]) }}"
                class="btn btn-warning float-end ms-2">Print</a>
            <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end">Tambah
                Data</button>

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Asset</th>
                        <th>Tanggal Disposal</th>
                        <th>Pemilik</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disposal as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->barang->nama_barang }}</td>
                            <td>{{ date('d/m/Y', strtotime($d->tgl_disposal)) }}</td>
                            <td>{{ $d->from == 'user' ? $d->karyawan->nama : 'Cabang :' . $d->cabang->nama }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td><span
                                    class="badge {{ $d->status == 'pending' ? 'bg-warning' : ($d->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $d->status }}</span>
                            </td>
                            <td>
                                @if ($d->status == 'pending')
                                    <button data-bs-toggle="modal" data-bs-target="#edituser"
                                        data-id="{{ $d->id }}" class="btn btn-warning btn-sm geteditData"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <a href="{{ route('disposal.delete', $d->id) }}"
                                        onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></a>
                                @else
                                @endif
                                <a href="{{ route('disposal.print', $d->id) }}" class="btn btn-sm btn-warning"><i
                                        class="bi bi-printer"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
    <form action="{{ route('disposal.store') }}" method="post" class="submit">
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
                <div class="col-lg-6  mt-2">
                    <label for="">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control ">
                        <option value="">-Pilih Karyawan-</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6  mt-2">
                    <label for="">Asset</label>
                    <select name="barang_id" id="barang_id" class="form-control ">

                    </select>
                </div>
                <div class="col-lg-6  mt-2">
                    <label for="">Tanggal Disposal</label>
                    <input type="date" name="tgl_disposal" class="form-control">
                </div>
                <div class="col-lg-6  mt-2">
                    <label for="">Jumlah Peminjaman</label>
                    <input type="text" class="form-control qty">
                </div>
                <div class="col-lg-6  mt-2">
                    <label for="">Jumlah Yang Disposal</label>
                    <input type="number" class="form-control qty2 " max="" name="jumlah">
                </div>


                <div class="col-lg-6  mt-2">
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control " name="keterangan">
                </div>

            </div>
        </x-modal>
    </form>
    <form action="{{ route('disposal.update') }}" method="post" enctype="multipart/form-data" class="submit">
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

                $(document).on('click', '.geteditData', function(e) {
                    var id = $(this).attr('data-id');

                    $.ajax({
                        url: "/disposal/getEdit",
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
