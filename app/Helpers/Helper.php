<?php

use App\Models\Lens;

function checkStockExists($request, $id)
{
    $axis = $request->axis;
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
            $axis = $axis;
    endswitch;
    $products = Lens::where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('axis', $axis)->whereIn('sph', $sph)->whereIn('cyl', $cyl)->when($id > 0, function ($q) use ($id) {
        return $q->where('id', $id);
    })->get();
    return ($id > 0 && count($products) == 1) ? collect() : $products;
}
