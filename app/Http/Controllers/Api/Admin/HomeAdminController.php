<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_admin', ['except' => ['login', 'register']]);
    }

    public function index()
    {
        $data = [];
        $data['total_sales'] = Order::sum('total');
        $data['total_products'] = Product::count();
        $data['total_orders'] = Order::count();
        $data['total_users'] = User::count();
        return successResponse($data);
    }
}
