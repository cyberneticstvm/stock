@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Lens Type</h1>
                <small class="text-muted">Stock Tracking / Create Lens Type</small>
            </div>
        </div>
    </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container-fluid">
        <div class="row g-3 clearfix">
            <div class="card mb-2">
                <div class="card-body p-4">
                    @include("sections.message")
                    <form action="{{ route('stock.tracking.save.type') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-5">
                                <label class="form-label req">Lens Type Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-lg" placeholder="Lens Type Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()" class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-4 table-responsive">
                    @include("sections.message")
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Type Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($types as $key => $type)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $type->name }}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection