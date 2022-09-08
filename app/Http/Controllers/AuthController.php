<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Http\Traits\SMSTrait;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //
    use SMSTrait;
    use ApiResponse;

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] = $auth->name;

            return $success['token'];
            // return Auth::user();
        }else{
            return 'Unauthorised';
        }
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gender' => 'required',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' =>Hash::make($request->password),
        ]);

        $sms = $this->send_sms($user);

        $user['sms'] = $sms;

        return $this->sendJson($user);



    }

    public function test()
    {
        // return sum_number(7,2);
        return Multiply_two_numbers(3,6);
    }

    public function test2()
    {
        return $this->send_sms(); // function in triat folder
    }
}
