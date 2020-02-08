<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\IndonesianMobileNumber;
use App\User;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required','max:255', 'unique:users', 'max:16', new IndonesianMobileNumber],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }
        $user = User::create($request->all());
        return $user;
    }
    public function all()
    {
        $alluser = User::all();
        return $alluser;
    }
}