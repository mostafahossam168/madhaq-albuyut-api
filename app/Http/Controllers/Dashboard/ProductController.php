<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::paginate(num_pag());
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => "required|string|max:255|unique:products,name",
                'category_id' => "required|exists:categories,id",
                'price' => "required|numeric",
                'description' => "required|string",
                'images.*' => "required|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        $product = Product::create($request->except('images'));
        foreach ($request->images as $image) {
            $image = 'uploads/products/' . $this->saveImage($image, 'products');
            $product->images()->create(['url' => $image]);
        }
        return redirect()->route('admin.products.index')->with('success', 'تم انشاء المنتج بنجاح');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $request->validate(
            [
                'name' => "required|string|max:255|unique:products,name",
                'category_id' => "required|exists:categories,id",
                'price' => "required|numeric",
                'description' => "required|string",
                'images.*' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        $product->update($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($product->images as  $image) {
                $this->deleteImage($image->url);
            }
            foreach ($request->images as $image) {
                $image = 'uploads/products/' . $this->saveImage($image, 'products');
                $product->images()->create(['url' => $image]);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFial($id);
        foreach ($product->images as $image) {
            $this->deleteImage($image->url);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}