<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\ApiCode;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);
        
        $user = User::where('email', $credentials['email'])->first();

        // dd($user);
        if (!$user) {
            return $this->sendResponse('error', 'email tidak tersedia', NULL, 401);
        }

        Password::sendResetLink($credentials);

        return $this->respondWithMessage('success', 'Reset password link sent on your email id.');
    }

    public function reset(ResetPasswordRequest $request) {
        $email_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($email_password_status == Password::INVALID_TOKEN) {
            return $this->respondBadRequest(ApiCode::INVALID_RESET_PASSWORD_TOKEN);
        }
        return $this->resondWithMessage('success', 'Password Successfully changed');
    }
}
