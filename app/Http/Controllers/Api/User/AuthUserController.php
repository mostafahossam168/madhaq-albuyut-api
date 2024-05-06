<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class AuthUserController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgetPassword', 'resetPassword', 'changePassword']]);
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
        if ($token = auth()->attempt($credentials)) {
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
                'email' => "required|string|email|unique:users,email|max:255",
                'name' => "required|string|max:255",
                'phone' => "required|string:max:20|unique:users,phone",
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
            $data['image'] = 'uploads/users/' . $this->saveImage($request->image, 'users');
        }
        $user = User::create($data);
        $user = auth()->login($user);
        $token = $this->respondWithToken($user);
        return successResponse($token, 'تم انشاء الحساب بنجاح');
    }


    public function profile()
    {
        return successResponse(new UserResource(auth()->user()));
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $valiadtion = Validator::make(
            $request->all(),
            [
                'email' => "required|string|email|max:255|unique:users,email," . $user->id,
                'name' => "required|string|max:255",
                'phone' => "required|string:max:20|unique:users,phone," .  $user->id,
                'password' => "nullable|string|min:5|max:255|confirmed",
                'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
            ]
        );
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $data = $request->except('password', 'image');
        if ($request->has('password') && $request->password != null) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image') && $request->image != null) {
            if (!str_contains($user->image, 'user.png')) {
                $this->deleteImage($user->image);
            }
            $data['image'] = 'uploads/users/' . $this->saveImage($request->image, 'users');
        }
        $user->update($data);
        return successResponse(new UserResource($user), 'تم تحديث البيانات بنجاح');
    }


    public function logout()
    {
        auth()->logout();
        return successResponse('', 'تم تسجيل الخروج بنجاح');
    }

    public function refresh()
    {
        return successResponse($this->respondWithToken(auth()->refresh()));
    }

    public function forgetPassword(Request $request)
    {
        $valiadtion = Validator::make($request->all(), [
            'phone' => "required|string|exists:users,phone"
        ]);
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $code = rand(11111, 99999);
        $user = User::where('phone', $request->phone)->first();
        $user->update([
            'code' => $code,
            'expire_at' => now()->addMinute(120),
        ]);

        // $message = "رمز الدخول لمتجر مذاق البيوت هو  :  $code";
        // $account_sid = getenv('TWILIO_SID');
        // $auth_token = getenv('TWILIO_TOKEN');
        // $number = getenv('TWILIO_FROM');
        // $client = new Client($account_sid, $auth_token);
        // $client->messages->create('+2' . $request->phone, [
        //     'from' => $number,
        //     'body' => $message,
        // ]);
        return successResponse(new UserResource($user), 'تم ارسال الكود بنجاح');
    }



    public function resetPassword(Request $request)
    {
        $valiadtion = Validator::make($request->all(), [
            'phone' => "required|string|exists:users,phone",
            'code' => "required|digits:5",
        ]);
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $user = User::where('phone', $request->phone)->where('code', $request->code)
            ->whereDate('expire_at', '>=', now())->first();
        if ($user) {
            return successResponse(new UserResource($user), 'تم تاكيد الكود بنجاح');
        }
        return errorResponse('كود غير صحيح');
    }



    public function changePassword(Request $request)
    {
        $valiadtion = Validator::make($request->all(), [
            'phone' => "required|string|exists:users,phone",
            'code' => "required|digits:5",
            'password' => "required|string|min:5|confirmed"
        ]);
        if ($valiadtion->fails()) {
            return errorResponse($valiadtion->errors(), 401);
        }
        $user = User::where('phone', $request->phone)->where('code', $request->code)
            ->whereDate('expire_at', '>=', now())->first();
        $user->update([
            'code' => null,
            'expire_at' => null,
            'password' => bcrypt($request->password)
        ]);
        return successResponse(new UserResource($user), 'تم اعادة الرقم السري بنجاح');
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
