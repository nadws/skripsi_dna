@if (session()->has('error'))
    <div class="col-lg-12">
        <div class="alert alert-danger">
            <i class="bi bi-emoji-frown-fill"></i> {{ session()->get('error') }}.
        </div>
    </div>
@endif
@if (session()->has('success'))
    <div class="col-lg-12">
        <div class="alert alert-success">
            <i class="bi bi-check2-circle"></i> {{ session()->get('success') }}.
        </div>
    </div>
@endif
