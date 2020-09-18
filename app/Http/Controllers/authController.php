<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;

class authController extends Controller
{

    public $successStatus = 200;

    public function login(Request $request){
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
 
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $success['key_login'] =  $user->createToken('LaravelAuthApp')->accessToken;
            $success['role'] =  auth()->user()->role;
            return response()->json(['token' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    
    public function lupa(Request $request){
            $dataUser = User::where([['username','=',$request->username],['email','=',$request->email]])->first();
            
        if($dataUser!=null){
            $success['key_login'] =  $dataUser->createToken('LaravelAuthApp')->accessToken;
            $success['new_password'] =  Str::random(8);
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Data tidak ada'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
            'username' => 'required|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'phone' => 'required|numeric|unique:App\Models\User,phone',
            'address' => 'required',
            'role' => 'required|alpha',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        $success['key_login'] =  $dataUser->createToken('LaravelAuthApp')->accessToken;
        $success['new_password'] =  'berhasil login';
        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function logout()
    {
        $logout = Auth::user()->token()->revoke();
        if($logout){
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
    }
    
    public function masuk()
    {
        return view('welcome');
    }
 
}
