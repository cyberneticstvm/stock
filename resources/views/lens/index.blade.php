@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Product Stock Register</h1>
                <small class="text-muted">Stock Tracking / Product Stock Register</small>
            </div>
        </div>
    </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container-fluid">
        <div class="row g-3 clearfix">
            <div class="card mb-2">
                <div class="card-body p-4 table-responsive">
                    <p class="text-end my-3"><a href="{{ route('stock.tracking.create') }}"><i class="fa fa-plus fa-lg text-success fw-bold"></i></a></p>
                    @include("sections.message")
                    <table id="dataTbl" class="table table-striped table-hover align-middle table-sm">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Location</th>
                                <th>Material</th>
                                <th>Coating</th>
                                <th>Type</th>
                                <th>Power</th>
                                <th>Qty</th>
                                <th>Shelf</th>
                                <th>Box</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lenses as $key => $lens)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $lens->location->name }}</td>
                                <td>{{ $lens->material->name }}</td>
                                <td>{{ $lens->coating->name }}</td>
                                <td>{{ $lens->type->name }}</td>
                                <td>{!! $lens->power() !!}</td>
                                <td>{{ $lens->qty }}</td>
                                <td>{{ $lens->shelf }}</td>
                                <td>{{ $lens->box }}</td>
                                <td class="text-center"><a href="{{ route('stock.tracking.edit', $lens->id) }}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('stock.tracking.delete', $lens->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
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