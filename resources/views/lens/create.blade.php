@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Create Product</h1>
                <small class="text-muted">Stock Tracking / Create Product</small>
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
                    <form action="{{ route('stock.tracking.save') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Location</label>
                                <select name="location_id" class="form-control form-control-lg show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($locations as $key => $location)
                                    <option value="{{ $location->id }}" {{ (old('location_id') == $location->id) ? 'selected' : '' }}>{{ $location->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('location_id')
                                <small class="text-danger">{{ $errors->first('location_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Material</label>
                                <select name="material_id" class="form-control form-control-lg show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($materials as $key => $material)
                                    <option value="{{ $material->id }}" {{ (old('material_id') == $material->id) ? 'selected' : '' }}>{{ $material->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('material_id')
                                <small class="text-danger">{{ $errors->first('material_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Coating</label>
                                <select name="coating_id" class="form-control form-control-lg show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($coatings as $key => $coating)
                                    <option value="{{ $coating->id }}" {{ (old('coating_id') == $coating->id) ? 'selected' : '' }}>{{ $coating->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('coating_id')
                                <small class="text-danger">{{ $errors->first('coating_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label req">Type</label>
                                <select name="type_id" class="form-control form-control-lg show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($types as $key => $type)
                                    <option value="{{ $type->id }}" {{ (old('type_id') == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('type_id')
                                <small class="text-danger">{{ $errors->first('type_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Eye</label>
                                <select class="form-control form-control-lg select2" name="eye">
                                    <option value="both">Both</option>
                                    <option value="re">RE</option>
                                    <option value="le">LE</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">SPH</label>
                                <input type="text" name="sph" class="form-control form-control-lg" value="{{ old('sph') }}" placeholder="SPH" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">CYL</label>
                                <input type="text" name="cyl" class="form-control form-control-lg" value="{{ old('cyl') }}" placeholder="CYL" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">AXIS</label>
                                <input type="text" name="axis" class="form-control form-control-lg" value="{{ old('axis') }}" placeholder="AXIS" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">ADD</label>
                                <input type="text" name="add" class="form-control form-control-lg" value="{{ old('add') }}" placeholder="ADD" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Qty</label>
                                <input type="number" name="qty" class="form-control form-control-lg" value="{{ old('qty') }}" placeholder="0">
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Shelf</label>
                                <input type="text" name="shelf" class="form-control form-control-lg" value="{{ old('shelf') }}" placeholder="Shelf">
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Box</label>
                                <input type="text" name="box" class="form-control form-control-lg" value="{{ old('box') }}" placeholder="Box">
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()" class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- .row end -->
    </div>
</div>
@endsection