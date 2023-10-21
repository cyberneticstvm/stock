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
        return $q->whereRaw("IF($spherical, CAST($spherical AS DECIMAL(4,2)) = CAST(sph AS DECIMAL(4,2))+CAST(cyl AS DECIMAL(4,2)), 1)")->where('cyl', number_format(0 - $cylinder, 2))->orWhereRaw("sph=$spherical AND cyl=$cylinder");
        //orWhere('sph', number_format($spherical, 2))->where('cyl', number_format($cylinder, 2));
    })->when($request->sph != '' && $request->cyl == '', function ($q) use ($sph) {
        return $q->whereIn('sph', $sph); //->where('cyl', '=', '')->orWhereNull('cyl');
    })->when($request->sph == '' && $request->cyl != '', function ($q) use ($cyl) {
        return $q->whereIn('cyl', $cyl); //->where('sph', '=', '')->orWhereNull('sph');
    })->when($request->axis != '' || $request->axis != 0, function ($q) use ($axis) {
        return $q->whereIn('axis', $axis);
    })->get();
    return ($id > 0 && count($products) == 1) ? collect() : $products;
}
