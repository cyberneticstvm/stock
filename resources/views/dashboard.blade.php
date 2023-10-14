@extends("base")
@section("content")
<div class="container-fluid py-4">
    <h6>Welcome {{ Auth::user()->name }}!</h6>
    <div class="row">

    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Stock overview</h6>

                </div>
                <div class="card-body p-3">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection