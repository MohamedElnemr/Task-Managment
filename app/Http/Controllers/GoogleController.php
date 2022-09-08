<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\Http\Traits\SMSTrait;
use App\Http\Traits\ApiResponse;

use Illuminate\Http\Request;

class GoogleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);
                // $auth = auth()->user();
                $auth = Auth::user();
                $success['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
                return $success['token'];

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'gender'=> 'male',
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                $auth = Auth::user();
                $success['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
                return $success['token'];
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
