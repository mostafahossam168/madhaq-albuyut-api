<?php

function num_pag()
{
    return 10;
}


function successResponse($data, $message = null, $status = 200)
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $data,
    ], $status);
}
function errorResponse($message, $status = 400)
{
    return response()->json([
        'success' => false,
        'message' => $message,
    ], $status);
}






function notifyByFirebase($title, $tokens, $data = [])
{
    $registrationIDs = $tokens;

    $fcmMsg = [
        'title' => $title,
        'sound' => 'default',
        'color' => '#203E78',
    ];

    $fcmFields = [
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data,
    ];

    $headers = [
        'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


// $token = $request->user()->token;

// if ($token) {
//     $title = "لديك طلب جديد";
//     notifyByFirebase($title, $token, [
//         'content' => "لديك طلب جديد من العميل " . $request->user()->name,
//         'order_id' => $order->id
//     ]);
// }

// return apiResponse(200, 'The order has been requested successfully', [
//     'order' => $order->load('products'),
//     'notifications' => $notification
// ]);
