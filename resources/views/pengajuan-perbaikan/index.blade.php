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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('perbaikan.store') }}" method="post">
        @csrf
        <x-modal id="tambah" size="modal-lg">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Barang dari</label>
                    <select name="from" id="pemilik" class="form-control">
                        <option value="">Pilih Barang dari</option>
                        <option value="cabang">Cabang</option>
                        <option value="user">Karyawan</option>
                    </select>
                </div>
                {{-- user --}}
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control user" disabled>
                        <option value="">-Pilih Karyawan-</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Asset</label>
                    <select name="barang_id" id="barang_id" class="form-control user" disabled>

                    </select>
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Jumlah Peminjaman</label>
                    <input type="text" class="form-control qty" disabled>
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Jumlah Yang Diperbaiki</label>
                    <input type="number" class="form-control qty2 user" max="" disabled name="jumlah">
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Vendor</label>
                    <select name="vendor_id" id="" class="form-control user" disabled>
                        <option value="">-Pilih Vendor-</option>
                        @foreach ($vendor as $v)
                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Harga Estimasi Perbaikan</label>
                    <input type="number" class="form-control user" disabled name="biaya">
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Tanggal Estimasi Selesai</label>
                    <input type="date" class="form-control user" disabled name="tgl_estimasi">
                </div>
                <div class="col-lg-6 user mt-2" hidden>
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control user" disabled name="keterangan">
                </div>
                {{-- user --}}
                {{-- cabang --}}
                <div class="col-lg-6 cabang mt-2" hidden>
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
                </div>
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


                    } else {
                        $('.cabang').attr('hidden', false);
                        $('.cabang').attr('disabled', false);
                    }

                });
                $(document).on('change', '#karyawan_id', function(e) {

                    var karyawan_id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "{{ route('perbaikan.getAssetKaryawan') }}",
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
                        url: "{{ route('perbaikan.getStockCabang') }}",
                        data: {
                            barang_id: barang_id
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
