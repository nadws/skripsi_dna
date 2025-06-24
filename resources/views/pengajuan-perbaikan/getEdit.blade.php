<div class="row">

    <div class="col-lg-6 user mt-2">
        <label for="">Karyawan</label>
        <select name="karyawan_id" id="karyawan_id" class="form-control user">
            <option value="">-Pilih Karyawan-</option>
            @foreach ($karyawan as $k)
                <option value="{{ $k->id }}" @selected($k->id == $perbaikan->karyawan_id)>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Asset</label>
        <select name="barang_id" id="barang_id" class="form-control user">
            @foreach ($peminjaman as $item)
                @php
                    $nama_barang =
                        $item->barang->nama_barang .
                        ' Merk :' .
                        $item->barang->merek .
                        ' Kode Peminjaman :' .
                        $item->invoice;
                @endphp
                <option value="{{ $item->invoice }}" @selected($item->invoice == $perbaikan->barang_id)>{{ $nama_barang }}
                </option>
            @endforeach

        </select>
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Jumlah Peminjaman</label>
        <input type="text" class="form-control qty" value="{{ $stok->qty - $stok->qty_disposal }}" disabled>
        <input type="hidden" name="id" class="form-control" value="{{ $perbaikan->id }}">
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Jumlah Yang Diperbaiki</label>
        <input type="number" class="form-control qty2 user" max="{{ $stok->jumlah }}" value="{{ $perbaikan->jumlah }}"
            name="jumlah">
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Vendor</label>
        <select name="vendor_id" id="" class="form-control user">
            <option value="">-Pilih Vendor-</option>
            @foreach ($vendor as $v)
                <option value="{{ $v->id }}" @selected($v->id == $perbaikan->vendor_id)>{{ $v->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Harga Estimasi Perbaikan</label>
        <input type="number" class="form-control user" name="biaya" value="{{ $perbaikan->biaya }}">
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Tanggal Estimasi Selesai</label>
        <input type="date" class="form-control user" name="tgl_estimasi" value="{{ $perbaikan->tgl_estimasi }}">
    </div>
    <div class="col-lg-6 user mt-2">
        <label for="">Keterangan</label>
        <input type="text" class="form-control user" name="keterangan" value="{{ $perbaikan->keterangan }}">
    </div>

</div>
