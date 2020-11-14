<?php

namespace app\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
        ]);

        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken');
            $token = $tokenResult->token;

            if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

            $success['user_id'] = $user->id;
            $success['user_email'] = $user->email;
            $success['access_token'] = $tokenResult->accessToken;
            $success['token_type'] = 'Bearer';
            $success['expires_at'] = Carbon::parse(
                $token->expires_at
            )->toDateTimeString();

            return response()->json(['success' => $success], 200);
        }

        return response()->json([
            'error' => 'Invalid access credentials'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        try {
            $user = User::create($input);
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];

            switch ($errorCode) {
                case (1062):
                    return 'User already exists';
                default:
                    return 'Something went wrong';
            }
        }

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function getUserName($email)
    {
        $user = User::firstWhere('email', $email);

        return $user->email;
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'logout success'], 200);
    }
}
