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
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disposal as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->barang->nama_barang }}</td>
                            <td>{{ $d->from == 'user' ? $d->karyawan->nama : 'Cabang :' . $d->cabang->nama }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td><span
                                    class="badge {{ $d->status == 'pending' ? 'bg-warning' : ($d->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $d->status }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
    <form action="{{ route('disposal.store') }}" method="post">
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
                    <label for="">Jumlah Yang Disposal</label>
                    <input type="number" class="form-control qty2 cabang" max="" disabled name="jumlah">
                </div>
                <div class="col-lg-6 cabang mt-2" hidden>
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control cabang" disabled name="keterangan">
                </div> --}}
            </div>
        </x-modal>
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

            });
        </script>
    @endsection
</x-app-layout>
