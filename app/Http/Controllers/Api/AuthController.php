<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BergyUtils;

class AuthController extends Controller
{
    //Please add this method
    public function login() {
        // get email and password from request
        $credentials = request(['email', 'password']);
        // try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            // return response()->json(['error' => 'Unauthorized'], 401);
            return BergyUtils::return_types(401,'Invalid Email or Password');
        }
        $user =array(
            'bio_details'=>auth('api')->user(),
            //'role_details'=> BergyUtils::getUserRoles(auth('api')->user()->id),
            //'permissions'=>BergyUtils::getUserPermissions(auth('api')->user()->id)
        );
        $data = array(
            'user'=> $user,
            'token' => $token,
            'type' => 'bearer', // you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        );
        return BergyUtils::return_types(200,'Token successfully Generated', $data);
    }

    public function getUser(){
        $data = array(
            'bio_details'=>  auth('api')->user()
        );
        return BergyUtils::return_types(200,'My Details', $data);
    }


}
