<div class="row">
    <div class="col-lg-4">
        <img id="imagePreview" src="{{ asset('karyawan_image/' . $karyawan->foto) }}" alt="Preview Gambar"
            style="max-width: 150px;">
        <br>
        <input type="file" class="form-control" name="image" id="imageInput" >
    </div>
    <div class="col-lg-8">
        <div class="row">

            <div class="col-lg-6">
                <label for="">Nama Karyawan</label>
                <input type="text" class="form-control" name="nama" value="{{ $karyawan->nama }}">
                <input type="hidden" name="cabang_id" value="{{ $karyawan->cabang_id }}">
                <input type="hidden" name="id" value="{{ $karyawan->id }}">
            </div>

            <div class="col-lg-6 mt-2">
                <label for="">Departemen</label>
                <select name="departemen_id" id="" class="form-control">
                    <option value="">Pilih Departemen</option>
                    @foreach ($departemen as $c)
                        <option value="{{ $c->id }}" {{ $karyawan->departemen_id == $c->id ? 'selected' : '' }}>
                            {{ $c->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 mt-2">
                <label for="">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}">
            </div>
            <div class="col-lg-6 mt-2">
                <label for="">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" value="{{ $karyawan->tgl_lahir }}">
            </div>
            <div class="col-lg-6 mt-2">
                <label for="">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ $karyawan->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ $karyawan->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>
            <div class="col-lg-6 mt-2">
                <label for="">Tanggal Bergabung</label>
                <input type="date" class="form-control" name="tgl_gabung" value="{{ $karyawan->tgl_gabung }}">
            </div>
            <div class="col-lg-6 mt-2">
                <label for="">Alamat</label>
                <textarea name="alamat" id="" cols="10" rows="3" class="form-control">
            {{ $karyawan->alamat }}
        </textarea>
            </div>
        </div>
    </div>
</div>
