<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Family;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FamilyResorce;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;

class FamilyAdminController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:api_admin');
    }


    public function index()
    {

        $families = FamilyResorce::collection(Family::paginate(num_pag()));
        return successResponse($families);
    }

    public function filter($category_id)
    {
        // $products = ProductResource::collection(Product::where('category_id', $category_id)->paginate(num_pag()));
        // return successResponse($products);
    }


    public function add(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:255|unique:families,name",
                'description' => "required|string",
                'image' => "required|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $data = $validate->validated();
        $data['image'] = 'uploads/families/' . $this->saveImage($request->image, 'families');
        $family = Family::create($data);
        return successResponse('', 'تم انشاء الاسرة بنجاح');
    }


    public function update(Request $request, $id)
    {
        $family = Family::find($id);
        if (!$family) {
            return errorResponse('الاسرة غير موجود');
        }
        $validate = Validator::make(
            $request->all(),
            [
                'name' => "required|string|max:255|unique:families,name,$id",
                'description' => "required|string",
                'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($validate->fails()) {
            return errorResponse($validate->errors(), 401);
        }
        $data = $validate->validated();
        if ($request->hasFile('image')) {
            $this->deleteImage($family->image);
            $data['image'] = 'uploads/families/' . $this->saveImage($request->image, 'families');
        } else {
            unset($data['image']);
        }

        $family->update($data);
        return successResponse('', 'تم تعديل الاسرة بنجاح');
    }

    public function show($id)
    {
        $family = Family::find($id);

        if ($family) {
            $family = new FamilyResorce($family);
            return successResponse($family);
        }
        return errorResponse('الاسرة غير موجود');
    }


    public function remove($id)
    {
        $family = Family::find($id);
        if ($family) {
            $this->deleteImage($family->image);
            $family->delete();
            return successResponse('', 'تم حذف الاسرة بنجاح');
        }
        return errorResponse('الاسرة غير موجود');
    }
}