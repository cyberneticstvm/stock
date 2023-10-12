<?php

use App\Models\Lens;

function checkStockExists($request)
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
    $products = Lens::where('coating_id', $request->coating_id)->where('type_id', $request->type_id)->where('material_id', $request->material_id)->whereIn('axis', $axis)->whereIn('sph', $sph)->whereIn('cyl', $cyl)->get();
    return $products;
}
