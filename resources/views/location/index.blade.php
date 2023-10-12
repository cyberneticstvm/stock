@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Location</h1>
                <small class="text-muted">Location / Create Location</small>
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
                    <form action="{{ route('save.location') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-5">
                                <label class="form-label req">Location Name</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control form-control-lg" placeholder="Location Name">
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-7">
                                <label class="form-label req">Address</label>
                                <input type="text" value="{{ old('address') }}" name="address" class="form-control form-control-lg" placeholder="Address">
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
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
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Location Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $key => $br)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $br->name }}</td>
                                <td>{{ $br->address }}</td>
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