<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return successResponse(new SettingResource(Setting::first()));
    }
    public function statusOrder()
    {
        $data = [
            '1' => 'جاري الطلب',
            '2' => 'مرفوض',
            '3' => 'جاري التجهيز',
            '4' => 'مكتمل',
        ];
        return successResponse($data);
    }
}
