<div class="row">
    <input type="hidden" name="id" value="{{ $p->id }}">
    <table class="table">

        <tr>
            <th>Nama Asset</th>
            <th width="2%"> : </th>
            <th>{{ $p->barang->nama_barang }} ({{ $p->barang->merek }})</th>
        </tr>
        <tr>
            <th>Pemilik</th>
            <th width="2%"> : </th>
            <th>{{ $p->from == 'user' ? $p->karyawan->nama : 'Cabang :' . $p->cabang->nama }}</th>
        </tr>

        <tr>
            <th>Jumlah</th>
            <th width="2%"> : </th>
            <th>{{ $p->jumlah }}</th>
        </tr>
        <tr>
            <th>Vendor</th>
            <th width="2%"> : </th>
            <th>{{ $p->vendor->nama }}</th>
        </tr>
        <tr>
            <th>Biaya Estimasi</th>
            <th width="2%"> : </th>
            <th>Rp. {{ number_format($p->biaya, 0) }}</th>
        </tr>
        <tr>
            <th>Keterangan</th>
            <th width="2%"> : </th>
            <th>{{ $p->keterangan }}</th>
        </tr>

        @if ($p->status == 'rejected')
            <tr>
                <th>Alasan Penolakan</th>
                <th width="2%"> : </th>
                <th>
                    {{ $peminjaman->ket_presiden }}
                </th>
            </tr>
        @endif

    </table>
    <div class="col-lg-12">
        <label for="">Keputusan</label>
        <select name="status" id="" class="form-control keputusan" required>
            <option value="">-Pilih Keputusan-</option>
            <option value="approved">Setujui</option>
            <option value="rejected">Tolak</option>
        </select>
    </div>
    <div class="col-lg-12 mt-2 alasan" hidden>
        <label for="">Alasan Penolakan</label>
        <textarea name="ket_presiden" id="" cols="8" rows="5" class="form-control"></textarea>
    </div>
    <div class="col-lg-6 mt-2 alasan" hidden>
        <label for="">Ajukan ke disposal asset ?</label>
        <br>
        <input type="radio" name="disposal" value="disposal" id=""> disaposal
        <input type="radio" name="disposal" value="tidak" selected id=""> tidak
    </div>


</div>
