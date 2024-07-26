<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Resources\UserResource;
use App\Traits\UploadImage;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthAdminController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:api_admin', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $valiadtion = Validator::make(
            $request->all(),
            [
                'email' => "required|string|email|max:255",
                'password' => "required|string"
            ]
        );
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $credentials = request(['email', 'password']);
        if ($token = auth('api_admin')->attempt($credentials)) {
            $data = $this->respondWithToken($token);
            return successResponse($data, 'تم تسجيل الدخول بنجاح');
        }
        return errorResponse('البيانات غير صحيحه', 401);
    }

    public function register(Request $request)
    {
        $valiadtion = Validator::make(
            $request->all(),
            [
                'email' => "required|string|email|unique:admins,email|max:255",
                'name' => "required|string|max:255",
                'phone' => "required|string:max:20|unique:admins,phone",
                'password' => "required|string|min:5|max:255|confirmed",
                'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $data = $request->except('password', 'image');
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('image') && $request->image != null) {
            $data['image'] = 'uploads/admins/' . $this->saveImage($request->image, 'admins');
        }
        $user = Admin::create($data);
        $user = auth('api_admin')->login($user);
        $token = $this->respondWithToken($user);
        return successResponse($token, 'تم انشاء الحساب بنجاح');
    }



    public function logout()
    {
        auth('api_admin')->logout();
        return successResponse('', 'تم تسجيل الخروج بنجاح');
    }


    public function profile()
    {
        return successResponse(new AdminResource(auth('api_admin')->user()));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth('api_admin')->user();
        $valiadtion = Validator::make(
            $request->all(),
            [
                'email' => "required|string|email|max:255|unique:admins,email," . $admin->id,
                'name' => "required|string|max:255",
                'phone' => "required|string:max:20|unique:admins,phone," .  $admin->id,
                'password' => "nullable|string|min:5|max:255|confirmed",
                'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $data = $request->except('password');
        if ($request->has('password') && $request->password != null) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image') && $request->image != null) {
            if (!str_contains($admin->image, 'user.png')) {
                $this->deleteImage($admin->image);
            }
            $data['image'] = 'uploads/admins/' . $this->saveImage($request->image, 'admins');
        }
        $admin->update($data);
        return successResponse(new AdminResource($admin), 'تم تحديث البيانات بنجاح');
    }



    public function refresh()
    {
        return successResponse($this->respondWithToken(auth('api_admin')->refresh()));
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 240
        ]);
    }
}