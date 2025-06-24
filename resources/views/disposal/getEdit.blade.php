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
                <option value="{{ $k->id }}" @selected($k->id == $disposal->karyawan_id)>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6  mt-2">
        <label for="">Asset</label>
        <select name="barang_id" id="barang_id" class="form-control ">
            @foreach ($peminjaman as $item)
                @php
                    $nama_barang =
                        $item->barang->nama_barang .
                        ' Merk :' .
                        $item->barang->merek .
                        ' Kode Peminjaman :' .
                        $item->invoice;
                @endphp
                <option value="{{ $item->invoice }}" @selected($item->invoice == $disposal->barang_id)>{{ $nama_barang }}
                </option>
            @endforeach

        </select>
    </div>
    <div class="col-lg-6  mt-2">
        <label for="">Jumlah Peminjaman</label>
        <input type="text" class="form-control qty" value="{{ $stok->qty - $stok->qty_disposal }}" disabled>
    </div>
    <div class="col-lg-6  mt-2">
        <label for="">Jumlah Yang Disposal</label>
        <input type="number" class="form-control qty2 " max="" name="jumlah" value="{{ $disposal->jumlah }}">
    </div>


    <div class="col-lg-6  mt-2">
        <label for="">Keterangan</label>
        <input type="text" class="form-control " name="keterangan" value="{{ $disposal->keterangan }}">
    </div>

</div>
