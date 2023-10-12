@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header d-flex py-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="fs-4 mt-1 mb-0">Update Product</h1>
                <small class="text-muted">Stock Tracking / Update Product</small>
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
                    <form action="{{ route('stock.tracking.update', $product->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row g-4">
                            <div class="col-sm-3">
                                <label class="form-label req">Location</label>
                                <select name="location_id" class="form-control form-control-lg show-tick ms select2">
                                    <option value="">Select</option>
                                    @forelse($locations as $key => $location)
                                    <option value="{{ $location->id }}" {{ ($product->location_id == $location->id) ? 'selected' : '' }}>{{ $location->name }}</option>
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
                                    <option value="{{ $material->id }}" {{ ($product->material_id == $material->id) ? 'selected' : '' }}>{{ $material->name }}</option>
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
                                    <option value="{{ $coating->id }}" {{ ($product->coating_id == $coating->id) ? 'selected' : '' }}>{{ $coating->name }}</option>
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
                                    <option value="{{ $type->id }}" {{ ($product->type_id == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
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
                                    <option value="both" {{ $product->eye == 'both' ? 'selected' : '' }}>Both</option>
                                    <option value="re" {{ $product->eye == 're' ? 'selected' : '' }}>RE</option>
                                    <option value="le" {{ $product->eye == 'le' ? 'selected' : '' }}>LE</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">SPH</label>
                                <input type="text" name="sph" class="form-control form-control-lg" value="{{ $product->sph }}" placeholder="SPH" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">CYL</label>
                                <input type="text" name="cyl" class="form-control form-control-lg" value="{{ $product->cyl }}" placeholder="CYL" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">AXIS</label>
                                <input type="text" name="axis" class="form-control form-control-lg" value="{{ $product->axis }}" placeholder="AXIS" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">ADD</label>
                                <input type="text" name="add" class="form-control form-control-lg" value="{{ $product->add }}" placeholder="ADD" maxlength="6">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Qty</label>
                                <input type="number" name="qty" class="form-control form-control-lg" value="{{ $product->qty }}" placeholder="0">
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Shelf</label>
                                <input type="text" name="shelf" class="form-control form-control-lg" value="{{ $product->shelf }}" placeholder="Shelf">
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">Box</label>
                                <input type="text" name="box" class="form-control form-control-lg" value="{{ $product->box }}" placeholder="Box">
                            </div>
                            <div class="col-sm-12 text-end">
                                <button type="button" onClick="history.back()" class="btn btn-danger">Cancel</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary btn-submit">Update</button>
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