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
                        <th>Invoice</th>
                        <th>Asset</th>
                        <th>Suplier / Cabang</th>
                        <th>Jumlah</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>PER-{{ $p->invoice }}</td>
                            <td>{{ $p->barang->nama_barang }} ({{ $p->barang->merek }})</td>
                            <td>{{ empty($p->pembelian->suplier->nama) ? '' : 'Suplier ' . $p->pembelian->suplier->nama }}
                                {{ empty($p->overstock->cabang->nama) ? '' : 'Cabang ' . $p->overstock->cabang->nama }}
                            </td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->kategori }}</td>
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

    <form action="{{ route('permintaan.store') }}" method="POST">
        @csrf
        <x-modal size="modal-lg" id="tambah">
            <div class="row">
                <div class="col-lg-4">
                    <label for="">Invoice</label>
                    <input type="text" class="form-control" value="{{ $invoice }}" disabled>
                </div>
                <div class="col-lg-4">
                    <label for="">Kategori Permintaan</label>
                    <select name="katgeori" id="" class="form-control kategori">
                        <option value="">-Pilih Kategori-</option>
                        <option value="pembelian">Pembelian</option>
                        <option value="overstock">Overstock</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" required>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row pembelian" hidden>
                <div class="col-lg-6">
                    <label for="">Asset</label>
                    <select name="barang_id_pembelian" id="" class="form-control">
                        <option value="">-Pilih Asset-</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} ({{ $b->merek }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Suplier</label>
                    <select name="suplier_id_pembelian" id="" class="form-control">
                        <option value="">-Pilih Suplier-</option>
                        @foreach ($suplier as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah_pembelian" class="form-control">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan_pembelian" class="form-control" value="0"
                        min="0">
                </div>
            </div>
            <div class="row overstock" hidden>
                <div class="col-lg-6">
                    <label for="">Cabang</label>
                    <select name="cabang_id_overstock" id="" class="form-control get_aseet_cabang">
                        <option value="">-Pilih Cabang-</option>
                        @foreach ($cabang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Asset</label>
                    <select name="barang_id_overstock" id="" class="form-control load_asset">

                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Stock</label>
                    <input type="number" name="stock" class="form-control stock" disabled>
                </div>
                <div class="col-lg-6">
                    <label for="">Harga Satuan</label>
                    <input type="number" class="form-control harga" disabled>
                    <input type="hidden" name="harga_satuan_overstock" class="form-control harga">
                </div>
                <div class="col-lg-6">
                    <label for="">Jumlah Permintaan</label>
                    <input type="number" name="jumlah_overstock" class="form-control">
                </div>


            </div>

        </x-modal>
    </form>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.kategori', function(e) {
                    var kategori = $(this).val();
                    if (kategori == 'pembelian') {
                        $('.pembelian').attr('hidden', false);
                        $('.overstock').attr('hidden', true);
                    } else {
                        $('.pembelian').attr('hidden', true);
                        $('.overstock').attr('hidden', false);
                    }
                });
                $(document).on('change', '.get_aseet_cabang', function(e) {
                    var cabang_id = $(this).val();
                    $.ajax({
                        type: "get",
                        url: "{{ route('permintaan.get_asset') }}",
                        data: {
                            cabang_id: cabang_id
                        },
                        success: function(response) {
                            $('.load_asset').html(response);
                        }
                    });

                });
                $(document).on('change', '.load_asset', function(e) {
                    var barang_id = $(this).val();
                    var cabang_id = $('.get_aseet_cabang').val();

                    $.ajax({
                        type: "get",
                        url: "{{ route('permintaan.get_stock') }}",
                        data: {
                            barang_id: barang_id,
                            cabang_id: cabang_id
                        },
                        success: function(response) {

                            $('.stock').val(response.stok);
                            $('.harga').val(response.harga);

                        }
                    });



                });
            });
        </script>
    @endsection
</x-app-layout>
