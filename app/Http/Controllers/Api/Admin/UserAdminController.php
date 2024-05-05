<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_admin');
    }
    public function index()
    {
        $users = UserResource::collection(User::paginate(num_pag()));
        return successResponse($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $user = new UserResource($user);
            return successResponse($user);
        }
        return errorResponse('المستخدم غير موجود');
    }
}
