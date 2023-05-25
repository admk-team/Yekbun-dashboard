<?php

namespace App\Http\Controllers\Api;

use session;
use App\Models\User;
use App\Models\UserCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'user_id' => 'required',
        ]);

        $find = UserCode::where('user_id', $request->user_id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(15))
            ->first();


        if (isset($find)) {
            $find->update([
                'code' => $request->code,
                'user_id' => $request->user_id
            ]);

            $user = User::find($request->user_id);
            $user->status = 1;
            $user->save();
            return response()->json(['success' => true, 'message' => "Your account is successfully verfied.", "data" => $user]);
        }

        return response()->json(['success' => false, 'message' => "You entered an invalid code."]);
    }

    public function resend($id, $email)
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => $id],
            ['code' => $code]
        );

        try {

            $details = [
                'title' => 'Mail from Yekbun.com',
                'code' => $code
            ];

            Mail::to($email)->send(new SendCodeMail($details));
            return response()->json(['success' => true, "message" => "We sent vertifaction code to your provided email address"]);
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }
}
