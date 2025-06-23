<style>
    @media print {
        .btn_hilang {
            display: none;
        }
    }
</style>
<center>
    <div class="text-center">{!! QrCode::size(300)->generate(url("/peminjaman/getDataPeminjaman2?id=$id")) !!}</div>
    <p class="text-center mt-4">{{ $peminjaman->invoice }}</p>
</center>
<div class="text-center mt-2">

    <a class="btn btn-warning btn_hilang" target="_blank" href="{{ route('peminjaman.printQr', ['id' => $id]) }}">Print</a>
</div>
