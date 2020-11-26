<?php

namespace app\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use App\Models\Level;
use App\Models\LevelType;
use App\Models\SkillType;
use App\Constants;

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
            return response()->json(['error' => $validator->errors()->all()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        try {
            $user = User::create($input);
            $user->sendEmailVerificationNotification();
            $this->setUserGeneralLevel($user);

            $token = $user->createToken('authToken')->accessToken;
            $success['user_email'] = $user->email;
            $success['access_token'] = $token;

            return response()->json(['success' => $success], 200);
        }
        catch (QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            $error = [];

            switch ($errorCode) {
                case (1062):
                    $error['message'] = 'User already exists';

                    return response()->json(['error' => $error], $errorCode);
                default:
                    $error['message'] = 'Something went wrong';

                    return response()->json(['error' => $error], $errorCode);
            }
        }
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


    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'logout success'], 200);
    }

    public function verify(Request $request)
    {

        $request->user()->markEmailAsVerified();

        event(new Verified($request->user()));

        $success['message'] = 'e-mail verification successfull';

        return response()->json(['success' => $success], 200);
    }

    public function getUserName($email)
    {
        $user = User::firstWhere('email', $email);

        return $user->email;
    }

    public function getGeneralLevel()
    {
        $user = Auth::user();

        return Level::firstWhere('user_id', $user->id);
    }

    protected function setUserGeneralLevel(User $user)
    {
        $levelType = LevelType::where('type', 'general')->first();

        Level::create([
            'user_id' => $user->id,
            'skill_id' => null,
            'level_type' => $levelType->id,
            'current_level' => 0,
            'current_exp' => 0,
            'exp_to_level_up' => Constants::INITIAL_GENERAL_LEVEL,
            'exp_increase_ratio' => Constants::INITIAL_GENERAL_LEVEL_EXP_INCREASE_RATIO,
            'level_achievement_date' => Carbon::now()
        ]);
    }
}
