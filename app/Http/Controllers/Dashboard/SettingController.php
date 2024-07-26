<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $setting = Setting::first();
        return view('settings.index', compact('setting'));
    }
    public function update(Request $request)
    {
        $setting = Setting::first();
        $request->validate([
            'logo' => "nullable|image|max:1024",
            'text1' => "required|string|max:255",
            'image1' => "nullable|image|max:1024",
            'text2' => "required|string|max:255",
            'image2' => "nullable|image|max:1024",
            'text3' => "required|string|max:255",
            'image3' => "nullable|image|max:1024",
            'f_link' => "required|string|max:255",
            'i_link' => "required|string|max:255",
            't_link' => "required|string|max:255",
            'email' => "required|max:50|email",
            'phone' => "required|max:20",
            'conditions' => 'required|string',
            'policy' => 'required|string',
        ]);

        $data = $request->except('logo', 'image1', 'image2', 'image3');
        if ($request->file('logo') && $request->logo != null) {
            $data['logo'] = 'uploads/settings/' . $this->saveImage($request->logo, 'settings');
            $this->deleteImage($setting->logo);
        }
        if ($request->file('image1') && $request->image1 != null) {
            $data['image1'] = 'uploads/settings/' . $this->saveImage($request->image1, 'settings');
            $this->deleteImage($setting->image1);
        }
        if ($request->file('image2') && $request->image2 != null) {
            $data['image2'] = 'uploads/settings/' . $this->saveImage($request->image2, 'settings');
            $this->deleteImage($setting->image2);
        }
        if ($request->file('image3') && $request->image3 != null) {
            $data['image3'] = 'uploads/settings/' . $this->saveImage($request->image3, 'settings');
            $this->deleteImage($setting->image3);
        }
        $setting->update($data);
        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح ');
    }
}