<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(num_pag());
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => "required|string|max:255|unique:brands,name",
                'image' => "required|image|max:1024"
            ]
        );
        $data = $request->only('name');
        $data['image'] = '/uploads/brands/' . $this->saveImage($request->image, 'brands');
        Brand::create($data);
        return redirect()->back()->with('success', 'تم اضافة العلامة التجاريه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate(
            [
                'name' => "required|string|max:255|unique:brands,name,$id",
                'image' => "nullable|image|max:1024"
            ]
        );
        $data = $request->only('name');
        if ($request->hasFile('image') && $request->image != null) {
            $data['image'] = '/uploads/brands/' . $this->saveImage($request->image, 'brands');
            $this->deleteImage($brand->image);
        }
        $brand->update($data);
        return redirect()->back()->with('success', 'تم تعديل العلامة التجاريه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->image);
        $brand->delete();
        return redirect()->back()->with('success', 'تم حذف العلامة التجاريه بنجاح');
    }
}