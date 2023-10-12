<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Lens;
use App\Models\LensCoating;
use App\Models\LensMaterial;
use App\Models\LensType;
use Exception;
use Illuminate\Http\Request;

class LensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct(){
        $this->middleware('permission:lens-list|lens-create|lens-edit|lens-delete', ['only' => ['index','show']]);
        $this->middleware('permission:lens-create', ['only' => ['create','store']]);
        $this->middleware('permission:lens-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:lens-delete', ['only' => ['destroy']]);
    }*/

    public function createcoating()
    {
        $coating = LensCoating::orderBy('name')->get();
        return view('lens.coating', compact('coating'));
    }

    public function storecoating(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        LensCoating::insert([
            'name' => $request->name,
        ]);
        return redirect()->back()->with("success", "Coating created successfully!");
    }

    public function creatematerial()
    {
        $materials = LensMaterial::orderBy('name')->get();
        return view('lens.material', compact('materials'));
    }

    public function storematerial(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        LensMaterial::insert([
            'name' => $request->name,
        ]);
        return redirect()->back()->with("success", "Material created successfully!");
    }

    public function createtype()
    {
        $types = LensType::orderBy('name')->get();
        return view('lens.type', compact('types'));
    }

    public function storetype(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        LensType::insert([
            'name' => $request->name,
        ]);
        return redirect()->back()->with("success", "Type created successfully!");
    }

    public function index()
    {
        $lenses = Lens::all();
        return view('lens.index', compact('lenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Branch::all();
        $materials = LensMaterial::all();
        $types = LensType::all();
        $coatings = LensCoating::all();
        return view('lens.create', compact('locations', 'materials', 'types', 'coatings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'location_id' => 'required',
            'material_id' => 'required',
            'coating_id' => 'required',
            'type_id' => 'required',
        ]);
        try {
            $products = checkStockExists($request);
            if (!$products->isEmpty())
                return redirect()->back()->with("error", "Product exists!")->withInput($request->all());
            else
                $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            Lens::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stock.tracking.list')->with("success", "Stock created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $materials = LensMaterial::all();
        $types = LensType::all();
        $coatings = LensCoating::all();
        return view('lens.track', compact('materials', 'types', 'coatings'));
    }

    public function track(Request $request)
    {
        $this->validate($request, [
            'material_id' => 'required',
            'coating_id' => 'required',
            'type_id' => 'required',
        ]);
        try {
            $products = checkStockExists($request);
            if ($products->isEmpty())
                return redirect()->back()->with("error", "Product not found!")->withInput($request->all());
            else
                return redirect()->back()->with(['success' => 'Product Foound', 'products' => $products])->withInput($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Lens::findOrFail($id);
        $locations = Branch::all();
        $materials = LensMaterial::all();
        $types = LensType::all();
        $coatings = LensCoating::all();
        return view('lens.edit', compact('product', 'locations', 'materials', 'types', 'coatings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'location_id' => 'required',
            'material_id' => 'required',
            'coating_id' => 'required',
            'type_id' => 'required',
        ]);
        try {
            $products = checkStockExists($request);
            if (!$products->isEmpty())
                return redirect()->back()->with("error", "Product exists!")->withInput($request->all());
            else
                $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            $lens = Lens::findOrFail($id);
            $lens->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stock.tracking.list')->with("success", "Stock updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lens::findOrFail($id)->delete();
        return redirect()->route('stock.tracking.list')->with("success", "Stock deleted successfully");
    }
}
