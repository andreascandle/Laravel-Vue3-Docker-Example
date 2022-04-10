<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\Debugbar\Facades\Debugbar;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function login(Request $request)
    {
        Debugbar::info($request);
        Debugbar::info(Hash::make($request->password));
        $success = False;
        $message = 'Wrong Login';
        Debugbar::info(Auth::attempt(['username' => $request->email, 'password' =>  $request->password]));
        $success = false;
        $message = 'Unauthorised';
        if(Auth::attempt(['phone' => $request->email, 'password' =>  $request->password]) || 
        Auth::attempt(['email' => $request->email, 'password' =>  $request->password]) ||
        Auth::attempt(['username' => $request->email, 'password' =>  $request->password])){
            $success = true;
            $message = 'User login successfully';
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        Debugbar::info($response);
        return response()->json($response);
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function listUser(){
        $user = User::orderBy('id', 'desc')->get();
        return response()->json($user);
    }

    public function getUser($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function updateUser($id, Request $request){
        $user = User::find($id);
        $user->update($request->all());
 
        return response()->json('The post successfully updated');
    }
}
