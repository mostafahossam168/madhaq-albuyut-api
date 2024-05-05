<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAdminController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:api_admin');
    }


    public function index()
    {
        $products = ProductResource::collection(Product::paginate(num_pag()));
        return successResponse($products);
    }

    public function filter($category_id)
    {
        $products = ProductResource::collection(Product::where('category_id', $category_id)->paginate(num_pag()));
        return successResponse($products);
    }


    public function add(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:255|unique:products,name",
                'category_id' => "required|exists:categories,id",
                'price' => "required|numeric",
                'description' => "required|string",
                'images.*' => "required|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $product = Product::create($request->except('images'));
        foreach ($request->images as $image) {
            $image = 'uploads/products/' . $this->saveImage($image, 'products');
            $product->images()->create(['url' => $image]);
        }
        return successResponse('', 'تم انشاء المنتج بنجاح');
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return errorResponse('المتج غير موجود');
        }
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:255|unique:products,name,$id",
                'category_id' => "required|exists:categories,id",
                'price' => "required|numeric",
                'description' => "required|string",
                'images.*' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
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
        return successResponse('', 'تم تعديل المنتج بنجاح');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product = new ProductResource($product);
            return successResponse($product);
        }
        return errorResponse('المتج غير موجود');
    }


    public function remove($id)
    {
        $product = Product::find($id);
        if ($product) {
            foreach ($product->images as $image) {
                $this->deleteImage($image->url);
            }
            $product->delete();
            return successResponse('', 'تم حذف المنتج بنجاح');
        }
        return errorResponse('المنتج غير موجود');
    }
}
