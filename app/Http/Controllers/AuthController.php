<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use OTPService;
use App\User;
use App\Models\Mobile\OTP;
use App\Models\Mobile\UserDevice;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|confirmed'
        // ]);
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'title' => $request->title,
            'position' => $request->position,
            'latin' => $request->latin,
            'department' => $request->department,
            'duty' => $request->duty,
            'entity' => $request->entity,
            'telephone_1' => $request->telephone_1,
            'telephone_2' => $request->telephone_2,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);
    
        // $validatedData = $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Wrong username or password.'
            ], 200);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'accessToken' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userData' => $request->user()
        ]);
    }

    public function loginMobile(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);
        // $validatedData = $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);
        $input = $request->all();
        // $credentials = request(['username', 'password']);
        // print_r($credentials);
        $username = '+855'.intval($input['username']);
        $password = $input['password'];
        $input["telephone"] = $username;

        // $credentials = request(['username', 'password']);
        $credentials = array(
            "username" => $username,
            "password" => $password
        );
        // dd($credentials);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $this->registerDevice($input, $user->id);
        return response()->json([
            'accessToken' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userData' => $request->user()
        ]);
    }

    public function loginMobileOTP(Request $request)
    {
        $input = $request->all();
        $telephone = $input['telephone'];
        $hasUser = User::checkHasUser($telephone);
        $data = array();
        // if($hasUser){
            $otp = OTPService::getOTP($input);
            if(!$hasUser) {
                $user = new User([
                    'username' => $request->telephone,
                    'telephone_1' => $request->telephone,
                    'password' => bcrypt($otp["optCode"])
                ]);
                $user->save();
            }
            
            $data = array(        
                "success" => true,
                "optCode" => $otp["optCode"],
                "message" => "Opt code has been sent."
            );
        // }else{
        //     $data = array(        
        //         "success" => false,
        //         "message" => "Your account not yet exist!"
        //     );
        // }
        return response()->json([
            "data" => $data
        ]);
    }

    public function VerifyMobileOTP(Request $request)
    {
        $input = $request->all();
        $checkOTP = OTPService::checkOTP($request);
        $data = array();
        if($checkOTP){
            // login
            $credentials = array(
                                'username' => $input['telephone'],
                                'password' => $input['optCode']
                            );
            if(!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            $user = $request->user();
            // register user device
            $this->registerDevice($input, $user->id);
            // Create User Token Access
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $data = array(
                'accessToken' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'userData' => $request->user()
            );
            return response()->json([
                "data" => $data
            ]);
        }else{
            $data = array(        
                "success" => false,
                "message" => "Invalid OTP or expired code!"
            );
        }
        return response()->json([
            "data" => $data
        ]);
    }

    public function registerDevice($request, $userId)
    {
        $data = array();
        $userDevice = array(
            "user_id" => $userId,
            "telephone" => $request["telephone"],
            "optCode" => $request["optCode"],
            "device_type" => $request["device_type"],
            "device_token" => $request["device_token"]
        );
        if(!UserDevice::CheckUserDevice($request)){
            $table = UserDevice::create($userDevice);
            if($table){
                $status = 200;
                $boolen = true;
                $message = trans('account.message_success');
            }else{
                $status = 500;
                $boolen = false;
                $message = trans('account.message_error');
            }
            $data = array(
                "success" => $boolen,
                "message" => $message
            );
        }else{
            $status = 200;
            $data = array(
                "success" => true,
                "message" => "Account is already exist"
            );
        }
        
        return response()->json([
            "data" => $data
        ], $status);
    }
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        // dd("test");
        $request->user()->token()->revoke();
        $data = array(
            "message" => "Successfully logged out.",
            "success" => true
        );
        return response()->json([
            'data' => $data
        ]);
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($json);
    }
}