<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'is_private' => "nullable|boolean",
        ]);
        if ($validation->fails()) {
            return errorResponse($validation->errors());
        }

        $isPrivate = $request->filled('is_private') ? $request->is_private : 1;

        $chats = Chat::where('is_private', $isPrivate)
            ->hasParticipant(auth()->user()->id)
            ->hasCreatedBy(auth()->user()->id)
            ->with('participants.user', 'lastMessage.user')
            ->get();
        return successResponse($chats);
    }


    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => "required|exists:users,id",
            'name' => "nullable",
            'is_private' => "nullable|boolean",
        ]);
        if ($validation->fails()) {
            return errorResponse($validation->errors());
        }


        if ($request->user_id == auth()->user()->id) {
            return errorResponse('لايمكن عمل شات مع نفسك');
        }

        $previousChat = $this->previousChat($request->user_id);
        if ($previousChat == null) {
            $chat = auth()->user()->chats()->create([
                'is_private' => $request->is_private,
                'name' => $request->name,
            ]);

            $chat->participants()->create([
                'user_id' => $request->user_id
            ]);

            $chat->refresh()->load('participants.user', 'lastMessage.user');
            return successResponse($chat, 'تم انشاء الشات بنجاح');
        }

        return successResponse($previousChat, 'الشات موجود مسبقا');
    }



    private function previousChat($otherId)
    {
        return Chat::where('is_private', 1)
            ->hasParticipant($otherId)
            ->hasCreatedBy($otherId)
            ->first();
    }


    public function show($id)
    {
        $chat = Chat::where('id', $id)->where('is_private', 1)
            ->hasParticipant(auth()->user()->id)
            ->hasCreatedBy(auth()->user()->id)
            ->with('participants.user', 'lastMessage.user')
            ->first();
        if ($chat) {
            $chat->load('participants.user', 'lastMessage.user');
            return successResponse($chat);
        }

        return errorResponse('الشات غير موجود');
    }
}
