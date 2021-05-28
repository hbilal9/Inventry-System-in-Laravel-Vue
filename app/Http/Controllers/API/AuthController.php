<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{


    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Invalid username/password',
                'status_code' => 401
            ], 401);
        }

        $user = $request->user();

        if ($user->role == 'admin') {
            $tokenData = $user->createToken('Personal Access Token', ['admin']);
        }
        elseif ($user->role == 'manager') {
            $tokenData = $user->createToken('Personal Access Token', ['manager']);
        }
        else {
            $tokenData = $user->createToken('Personal Access Token', ['employee']);
        }

        $token = $tokenData->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        if ($token->save()) {
            return response()->json([
                'user' => $user,
                'access_token' => $tokenData->accessToken,
                'token_type' => 'Bearer',
                'token_scope' => $tokenData->token->scopes[0],
                'expires_at' => Carbon::parse($tokenData->token->expires_at)->toDateTimeString(),
                'status_code' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Some error occurred, Please try again',
                'status_code' => 500
            ], 500);
        }
    }

    public function profile(Request $request) {
        return response()->json($request->user(), 200);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Logout successfully!',
            'status_code' => 200
        ], 200);
    }

    function updateProfile(Request $request){
        $request->validate([
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:2',
            'phone' => 'required|min:10',
            'email' => 'required|email'
        ]);
        $user = $request->user();
        $update = User::where('id', $user->id)->first();
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->phone = $request->phone;
        $update->email = $request->email;

        if ($update->save()) {
            return response()->json($update, 200);
        }
    }


    public function resetPasswordRequest(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'We have sent a verification code to your email address',
                'status_code' => 200
            ], 200);
        } else {
            $random = rand(111111, 999999);

            $user->verification_code = $random;
            if ($user->save()) {
                $userData = array(
                    'email' => $user->email,
                    'full_name' => $user->name,
                    'random' => $random
                );

                Mail::send('emails.reset_password', $userData, function ($message) use ($userData) {
                    $message->from('no-reply@healthcare', 'Password Request');
                    // $message->sender('john@johndoe.com', 'John Doe');
                    $message->to($userData['email'], $userData['full_name']);
                    // $message->cc('john@johndoe.com', 'John Doe');
                    // $message->bcc('john@johndoe.com', 'John Doe');
                    // $message->replyTo('john@johndoe.com', 'John Doe');
                    $message->subject('Reset Password Request (Health Care)');
                    // $message->priority(3);
                    // $message->attach('pathToFile');
                });

                if (Mail::failures()) {
                    return response()->json([
                        'message' => 'Some error occurred, Please try again',
                        'status_code' => 500
                    ], 500);
                } else {
                    return response()->json([
                        'message' => 'We have sent a verification code to your email address',
                        'status_code' => 200
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => 'Some error occurred, Please try again',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|integer',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found/Invalid code',
                'status_code' => 401
            ], 401);
        } else {
            $user->password = bcrypt(trim($request->password));
            $user->verification_code = Null;

            if ($user->save()) {
                return response()->json([
                    'message' => 'Password updated successfully!',
                    'status_code' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Some error occurred, Please try again',
                    'status_code' => 500
                ], 500);
            }
        }
    }

    /**
     * change user account password
     *
     * @return response
     */
    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required|max:255',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json([
                'message' => 'Current password is wrong'
            ], 401);
        }

        $update = $request->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Password changed successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Some error occured please try again'
            ], 500);
        }
    }
}
