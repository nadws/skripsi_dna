@props(['size' => '', 'id' => 'tambah'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">{{ $id }} Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit_btn">Simpan</button>
                <button type="button" disabled class="btn btn-primary submit_proses" hidden>Proses ..</button>
            </div>
        </div>
    </div>
</div>
