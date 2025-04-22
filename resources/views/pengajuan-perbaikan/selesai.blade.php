<div class="row">
    <div class="col-lg-12">
        <label for="">Status Perbaikan</label>
        <select name="status" id="" class="form-control" required>
            <option value="">-Pilih Status-</option>
            <option value="finish">Selesai</option>
            <option value="crash">Ajukan ke disposal</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Biaya Estimasi</label>
        <input type="number" class="form-control" value="{{ $p->biaya }}" disabled>
        <input type="hidden" class="form-control" value="{{ $p->id }}" name="id">
    </div>
    <div class="col-lg-6">
        <label for="">Biaya Perbaikan</label>
        <input type="number" class="form-control" name="biaya">
    </div>
</div>
