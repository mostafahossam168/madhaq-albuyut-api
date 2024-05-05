<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CouponeResource;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $coupons = CouponeResource::collection(Coupon::paginate(num_pag()));
        return successResponse($coupons);
    }
    public function add(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'code' => "required|string|max:10",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $coupon = Coupon::where('code', $request->code)
            ->whereDate('expire_date', '>=', now())
            ->first();
        if ($coupon) {
            return successResponse(new CouponeResource($coupon), 'تم تطبيق الكود بنجاح');
        } else {
            return errorResponse('الكود غير صالح');
        }
    }
}
