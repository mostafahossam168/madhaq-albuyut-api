<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $categories = CategoryResource::collection(Category::paginate(num_pag()));
        return successResponse($categories);
    }
    public function show($id)
    {
        $category = new CategoryResource(Category::find($id));
        return successResponse($category);
    }
}