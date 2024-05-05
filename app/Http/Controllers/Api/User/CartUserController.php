<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class CartUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }



    public function index()
    {
        $products = auth()->user()->cart;
        $data = CartResource::collection($products);
        return successResponse($data);
    }


    public function add($product_id, Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'qty' => "required|integer"
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $product = Product::findOrFail($product_id);
        $checkItem = auth()->user()->cart()->where('product_id', $product_id)->first();
        if (!$checkItem) {
            auth()->user()->cart()->attach([
                $product_id => [
                    'qty' => $request->qty,
                    'price' => $product->price,
                ]
            ]);
            return successResponse('', 'تم اضافة المنتج بنجاح');
        } else {
            return errorResponse('تم اضافة المنتج من قبل');
        }
    }

    public function update($product_id, Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            ['qty' => "required|integer"]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }

        auth()->user()->cart()->sync([
            $product_id => [
                'qty' => $request->qty,
            ]
        ]);
        return successResponse('', 'تم تعديل البيانات بنجاح');
    }
    public function remove($product_id)
    {
        auth()->user()->cart()->detach($product_id);
        return successResponse('', 'تم خذف المنتج بنجاح');
    }
}
