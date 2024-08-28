<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_admin');
    }
    public function index()
    {
        $categories = CategoryResource::collection(Category::paginate(num_pag()));
        return successResponse($categories);
    }
    public function add(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:20|unique:categories,name",
                'family_id' => "required|exists:families,id",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        Category::create($validate->validated());
        return successResponse('', 'تم انشاء القسم بنجاح');
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:20|unique:categories,name,$id",
                'family_id' => "required|exists:families,id",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $category = Category::find($id);
        if ($category) {
            $category->update($validate->validated());
            return successResponse('', 'تم تعديل القسم بنجاح');
        }
        return errorResponse('القسم غير موجود');
    }
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category = new CategoryResource($category);
            return successResponse($category);
        }
        return errorResponse('القسم غير موجود');
    }
    public function remove($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return successResponse('', 'تم حذف القسم بنجاح');
        }
        return errorResponse('القسم غير موجود');
    }
}