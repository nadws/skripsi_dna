<div class="row">
    <input type="hidden" name="id" value="{{ $peminjaman->id }}">
    <table class="table">
        <tr>
            <th>Kode Peminjaman</th>
            <th width="2%"> : </th>
            <th>{{ $peminjaman->invoice }}</th>
        </tr>
        <tr>
            <th>Nama Karyawan</th>
            <th width="2%"> : </th>
            <th>{{ $peminjaman->karyawan->nama }}</th>
        </tr>
        <tr>
            <th>Cabang</th>
            <th width="2%"> : </th>
            <th>
                {{ $peminjaman->cabang->nama }}
            </th>
        </tr>
        <tr>
            <th>Barang</th>
            <th width="2%"> : </th>
            <th>
                {{ $peminjaman->barang->nama_barang }}
            </th>
        </tr>
        <tr>
            <th>Qty</th>
            <th width="2%"> : </th>
            <th>
                {{ $peminjaman->qty }}
            </th>
        </tr>
        <tr>
            <th>Ket</th>
            <th width="2%"> : </th>
            <th>
                {{ $peminjaman->ket }}
            </th>
        </tr>
        <tr>
            <th>status</th>
            <th width="2%"> : </th>
            <th>
                <span
                    class="badge {{ $peminjaman->status == 'pending' ? 'bg-warning' : ($peminjaman->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $peminjaman->status }}</span>
            </th>
        </tr>
        @if ($peminjaman->status == 'rejected')
            <tr>
                <th>Alasan Penolakan</th>
                <th width="2%"> : </th>
                <th>
                    {{ $peminjaman->ket_presiden }}
                </th>
            </tr>
        @endif
        <tr>
            <th colspan="3">
                <image src="{{ asset('peminjaman_image/' . $peminjaman->file) }}" width="50%" height="50%"
                    alt="">
            </th>
        </tr>


    </table>
    @if ($role == 'manager')
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
    @endif

</div>
