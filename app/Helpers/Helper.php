<?php

use App\Models\Lens;
use Illuminate\Support\Facades\DB;

function checkStockExists($request, $id)
{
    $axis = $request->axis;
    $spherical = $request->sph;
    $cylinder = $request->cyl;
    $sph = [$request->sph, $request->sph + 10];
    $cyl = [$request->cyl, 0 - $request->cyl];
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
    /*$products = Lens::where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('axis', $axis)->whereIn('sph', $sph)->whereIn('cyl', $cyl)->when($id > 0, function ($q) use ($id) {
        return $q->where('id', $id);
    })->get();*/
    $products = Lens::when($request->coating_id != '', function ($q) use ($request) {
        return $q->where('coating_id', $request->coating_id);
    })->when($request->type_id != '', function ($q) use ($request) {
        return $q->where('type_id', $request->type_id);
    })->when($request->material_id != '', function ($q) use ($request) {
        return $q->where('material_id', $request->material_id);
    })->when($request->sph != '' || $request->sph != 0, function ($q) use ($sph) {
        return $q->whereIn('sph', $sph);
    })->when($request->cyl != '' || $request->cyl != 0, function ($q) use ($cyl) {
        return $q->whereIn('cyl', $cyl);
    })->when($spherical != '' && $cylinder != '', function ($q) use ($spherical) {
        return $q->WhereRaw("IF($spherical, CAST($spherical AS DECIMAL(4,2)) = CAST(sph1 AS DECIMAL(4,2))+CAST(cyl AS DECIMAL(4,2)), 1)");
    })->when($request->axis != '' || $request->axis != 0, function ($q) use ($axis) {
        return $q->whereIn('axis', $axis);
    })->get();
    return ($id > 0 && count($products) == 1) ? collect() : $products;
}
