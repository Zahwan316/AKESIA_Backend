<?php

namespace App\Http\Controllers\Fcm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class FcmNotificationController extends Controller
{//
    public function saveFcmToken(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user = User::find(auth()->guard()->user()->id); // asumsikan pakai auth:api atau sanctum
        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json(['message' => 'FCM token saved']);
    }

}
