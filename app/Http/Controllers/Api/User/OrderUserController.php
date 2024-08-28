<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        if ($request->has('status')) {
            $orders = auth()->user()->orders()->where('status', $request->status)->get();
        } else {
            $orders =  auth()->user()->orders;
        }
        $orders = OrderResource::collection($orders);
        return successResponse($orders);
    }
    public function add(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'phone' => "required|string|max:20",
                'address' => "required|string",
                // 'subtotal' => "required|numeric",
                'discount' => "required|numeric",
                // 'total' => "required|numeric",
                'payment_id' => "required|exists:payments,id",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        //Product In Carts
        $products = auth()->user()->cart->mapWithKeys(function ($product) {
            return [
                $product->id => [
                    'qty' => $product->pivot->qty,
                    'price' => $product->pivot->price,
                ]
            ];
        });
        if (!count($products)) {
            return successResponse('السله فارغه');
        }

        $data = $validate->validated();
        $totalPrice = auth()->user()->cart->sum(function ($product) {
            return $product->pivot->qty * $product->pivot->price;
        });
        $data['subtotal'] = $totalPrice;
        $data['total'] = $totalPrice - $data['discount'];

        //New Order
        $order = auth()->user()->orders()->create($data);
        //Add Product To Order
        $order->products()->attach($products);
        //Delete Product From Cart
        auth()->user()->cart()->detach();
        return successResponse($order, 'تم انشاء الطلب بنجاح');
    }
    public function show($id)
    {
        $order = auth()->user()->orders()->where('id', $id)->first();
        if ($order) {
            $order = new OrderResource($order);
            return successResponse($order);
        }
        return errorResponse('الطلب غير موجود');
    }
}