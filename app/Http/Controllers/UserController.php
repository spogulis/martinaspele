<?php

namespace app\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Laravel\Passport\Passport;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('authToken')->accessToken;

            return response()->json(['success' => $success]);
        }

        return response()->json(['error' => 'Invalid access credentials'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
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

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success]);
    }

    public function getDetails()
    {
        return response()->json(['success' => Auth::user()]);
    }
}
