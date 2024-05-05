<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function add($product_id, Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'rate' => "required|integer|max:5",
                'notes' => "required|string"
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $checkItem = auth()->user()->rates()->where('product_id', $product_id)->first();
        if (!$checkItem) {
            auth()->user()->rates()->attach([
                $product_id => [
                    'rate' => $request->rate,
                    'notes' => $request->notes,
                ]
            ]);
            return successResponse('', 'تم اضافة التقييم بنجاح');
        } else {
            return errorResponse('تم تقييم المنتج من قبل');
        }
    }

    public function remove($product_id)
    {
        auth()->user()->rates()->detach($product_id);
        return successResponse('', 'تم خذف التقييم بنجاح');
    }
}
