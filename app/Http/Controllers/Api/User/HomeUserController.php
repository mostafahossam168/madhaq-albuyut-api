<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Family;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\FamilyResorce;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

class HomeUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = [];
        $data['profile'] = new UserResource(auth()->user());
        $data['categories'] = CategoryResource::collection(Category::paginate(num_pag()));
        $data['products'] = ProductResource::collection(Product::paginate(num_pag()));
        $data['families'] = FamilyResorce::collection(Family::active()->paginate(num_pag()));
        return successResponse($data);
    }
}