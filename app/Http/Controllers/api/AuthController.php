<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ]);
    }
    public function register(Request $request){
        //deixar pra depois
    }
    public function logout() {
          try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response([
            'status' => 'success',
            'msg' => 'Deslogado com Sucesso!'
        ]);
        } catch (JWTException $e) {
            return response([
                'status' => 'error',
                'msg' => 'Falha ao deslogar, tente novamente'
            ]);
        }
    }
    public function refresh()
    {
      if($token = JWTAuth::getToken()){
        $new_token = JWTAuth::refresh($token);
          return response([
              'status' => 'success',
              'token' => $new_token
          ]);
      }else{
        return response([
            'status' => 'error',
            'msg' => 'Falha ao deslogar, tente novamente'
        ]);}
      }

    public function me()
    {

            if (! $user =  JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user_not_found'], 404);
            }

        return response()->json(compact('user'));
    }

    public function teste()
    {
      return response([
        'status' => 'Api Funcionando',
      ]);

    }

}
