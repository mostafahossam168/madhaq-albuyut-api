<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use Illuminate\Http\Request;

class FavoriteUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $products = auth()->user()->favorite;
        $data = FavoriteResource::collection($products);
        return successResponse($data);
    }

    public function add($product_id)
    {
        $checkItem = auth()->user()->favorite->where('id', $product_id)->first();
        if (!$checkItem) {
            auth()->user()->favorite()->attach($product_id);
        }
        return successResponse('', 'تم اضافة المنتج بنجاح');
    }

    public function remove($product_id)
    {
        auth()->user()->favorite()->detach($product_id);
        return successResponse('', 'تم خذف المنتج بنجاح');
    }
}