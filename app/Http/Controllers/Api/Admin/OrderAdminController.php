<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_admin');
    }

    public function index(Request $request)
    {
        $orders = Order::where(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        })->latest()->paginate(num_pag());
        $orders = OrderResource::collection($orders);
        return successResponse($orders);
    }


    public function show($id)
    {
        $order =  Order::find($id);
        if ($order) {
            $order = new OrderResource($order);
            return successResponse($order);
        }
        return errorResponse('الطلب غير موجود');
    }



    public function orderPendeing()
    {
        $orders = Order::where('status', 1)->latest()->paginate(num_pag());
        $orders = OrderResource::collection($orders);
        return successResponse($orders);
    }


    public function confirmOrder($id)
    {
        $order = Order::where('status', 1)->where('id', $id)->first();
        if ($order) {
            $order->update(['status', 3]);
            return successResponse($order, 'تم تاكيد الطلب');
        }
        return errorResponse('الطلب غير موجود');
    }


    public function cancelOrder($id)
    {
        $order = Order::where('status', 1)->where('id', $id)->first();
        if ($order) {
            $order->update(['status', 2]);
            return successResponse($order, 'تم الغاء الطلب');
        }
        return errorResponse('الطلب غير موجود');
    }
}