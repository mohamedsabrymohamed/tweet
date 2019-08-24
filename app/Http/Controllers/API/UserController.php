<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRegister;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegister $request)
    {
        $validated = $request->validated();
        //upload image
        if(request()->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(storage_path('app/public/'), $imageName);
            $validated['image']    = $imageName;
        }
        //encrypt password
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name']  = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}