<?php

use App\Models\Lens;
use Illuminate\Support\Facades\DB;

function checkStockExists($request, $id)
{
    $axis = $request->axis;
    $spherical = $request->sph;
    $cylinder = $request->cyl;
    $sph = [$request->sph, number_format($request->sph, 2)];
    $cyl = [$request->cyl, number_format(0 - $request->cyl, 2)];
    $add = [number_format($request->add, 2), number_format($request->add + 0.25, 2), number_format($request->add - 0.25, 2)];
    switch ($axis):
        case $axis <= 90:
            $axis = [$axis, $axis + 90];
            break;
        case $axis > 90:
            $axis = [$axis, $axis - 90];
            break;
        default:
            $axis = [$axis];
    endswitch;
    $products = Lens::when($request->coating_id != '', function ($q) use ($request) {
        return $q->where('coating_id', $request->coating_id);
    })->when($request->type_id != '', function ($q) use ($request) {
        return $q->where('type_id', $request->type_id);
    })->when($request->material_id != '', function ($q) use ($request) {
        return $q->where('material_id', $request->material_id);
    })->when($request->sph != '' && $request->cyl != '', function ($q) use ($spherical, $cylinder) {
        return $q->whereRaw("IF($spherical, CAST($spherical AS DECIMAL(4,2)) = CAST(sph AS DECIMAL(4,2))+CAST(cyl AS DECIMAL(4,2)), 1)")->whereRaw("IF($cylinder, CAST($cylinder AS DECIMAL(4,2)) = CAST(0-cyl AS DECIMAL(4,2)), 1)")->orWhereRaw("sph=$spherical AND cyl=$cylinder");
    })->when($request->sph != '' && $request->cyl == '', function ($q) use ($sph) {
        return $q->whereIn('sph', $sph)->whereNull('cyl')->orwhere('cyl', 0);
    })->when($request->sph == '' && $request->cyl != '', function ($q) use ($cyl, $cylinder) {
        return $q->whereIn('cyl', $cyl)->whereNull('sph')->orWhere('sph', number_format(0 - $cylinder, 2))->orWhere('sph', 0);
    })->when($request->axis != '', function ($q) use ($axis) {
        return $q->whereIn('axis', $axis);
    })->when($request->add != '' && $request->add > 0, function ($q) use ($add) {
        return $q->whereIn('add', $add);
    })->orderByDesc('add')->get();
    return ($id > 0 && count($products) == 1) ? collect() : $products;
}
