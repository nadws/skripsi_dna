<div class="row">
    <div class="col-lg-12">
        <label for="">Status Perbaikan</label>
        <select name="status" id="" class="form-control status" required>
            <option value="">-Pilih Status-</option>
            <option value="finish">Selesai</option>
            <option value="crash">Ajukan ke disposal</option>
        </select>
    </div>

    <div class="col-lg-6 finish" hidden>
        <label for="">Biaya Estimasi</label>
        <input type="number" class="form-control" value="{{ $p->biaya }}" disabled>
        <input type="hidden" class="form-control" value="{{ $p->id }}" name="id">
    </div>
    <div class="col-lg-6 finish" hidden>
        <label for="">Biaya Perbaikan</label>
        <input type="number" class="form-control detail_finish" name="biaya" disabled>
    </div>

    <div class="col-lg-6 mt-2 crash" hidden>
        <label for="">Keterangan</label>
        <input type="text" class="form-control detail_crash" name="keterangan" disabled>
    </div>
    <div class="col-lg-6 mt-2 crash" hidden>
        <label for="">Ajukan ke disposal asset ?</label>
        <br>
        <input type="radio" name="disposal" value="disposal" id=""> disaposal
        <input type="radio" name="disposal" value="tidak" selected id=""> tidak
    </div>
