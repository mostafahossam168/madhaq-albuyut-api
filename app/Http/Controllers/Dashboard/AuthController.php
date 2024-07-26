<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:admin')->only('logout');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ]);
        $remember = $request->remember ?? false;
        if (auth('admin')->attempt($request->only('email', 'password'), $remember)) {
            return redirect()->route('admin.home');
        }
        return  redirect()->back()->withInput($request->only('email'))->with('error', 'البيانات المدخلة غير صحيحه');
    }

    public function profile()
    {
        $profile = auth('admin')->user();
        return view('profile.index', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth('admin')->user();
        $request->validate([
            'email' => "required|string|email|max:255|unique:admins,email," . $user->id,
            'name' => "required|string|max:255",
            'phone' => "required|string:max:20|unique:admins,phone," .  $user->id,
            'password' => "nullable|string|min:5|max:255|confirmed",
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
        ]);
        $data = $request->except('password', 'image');
        if ($request->has('password') && $request->password != null) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image') && $request->image != null) {
            if (!str_contains($user->image, 'user.png')) {
                $this->deleteImage($user->image);
            }
            $data['image'] = 'uploads/admins/' . $this->saveImage($request->image, 'admins');
        }
        $user->update($data);
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }


    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login.form')->with('success', 'تم تسجيل الخروج بنجاح ');
    }
}