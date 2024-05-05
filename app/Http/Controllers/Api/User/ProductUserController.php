<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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


    public function show($id)
    {
        $product = new ProductResource(Product::find($id));
        return successResponse($product);
    }
}
