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
        $user = Auth::user();
        return response([
            'status' => 'success',
            'token' => $token,
            'user' => $user
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
    public function esqueceu_senha(Request $request){
        $email = $request->input('email');
        $user = User::where('email',$email)->first();
        if($user != null){
            if(!empty($user->email == $email)){
                $token = md5($email).str_random(16);
                User::find($user->id)->update(['token' => $token]);
                return response([
                    'status' => 'success',
                    'token' => $token
                ]);
            }
        }else{
            return response([
                'status' => 'error',
                'erro' => 'Usuário não existe'
            ]);
        }

    }
    public function muda_senha(Request $request){
        $email = $request->input('email');
        $senha = $request->input('senha');
        $token = $request->input('token');
        if(!empty( $email ) AND !empty($senha ) AND !empty($token)){
            $user = User::where('email',$email)->first();
            $id = $user->id;
            $verifica = User::where('token',$token)->where('id', $id )->first();
            if($verifica != null){
                if($verifica->token == $token){

                    User::find($id)->update(['password' => bcrypt($senha)]);
                    return response([
                        'status' => 'success',
                        'msg' => 'Senha alterada com sucesso'
                    ]);
                }
            }else{
                return response([
                    'status' => 'error',
                    'erro' => 'token inválido'
                ]);
            }
        }else{
            return response([
                'status' => 'error',
                'erro' => 'faltando informações'
            ]);
        }
    }

}
