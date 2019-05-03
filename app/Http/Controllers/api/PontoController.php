<?php

namespace App\Http\Controllers\api;

use App\catraca;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ponto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PontoController extends Controller
{
    public function ponto(Request $request){

      $latitude = $request->input("latitude");
      $longitude = $request->input("longitude");
      $data = Carbon::now('America/Sao_Paulo');

      $hora =   $data->format('H:i');
    	//-23.5264093
    	//-46.6664467

    	if(empty($latitude) or empty($longitude)){
    		return response([
            'status' => 'error_inserir',
            'erro' => 'Insira latitude e longitude'
        	]);
    	}
      $valida_long = (-23.52000>=$latitude)&&($latitude>=-23.54999);
      $valida_lat = (-46.00000>=$longitude)&&($longitude>=-49.66999);
      if($valida_long  &&  $valida_lat  ){
          $endpoint = "https://us1.locationiq.com/v1/reverse.php?key=43706011dbee3d&lat=".$latitude."&lon=".$longitude."&format=json";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $endpoint);
          curl_setopt($ch, CURLOPT_POST, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          $err = curl_error($ch);  //if you need
          curl_close ($ch);
          $user = Auth::id();

          $entrada = DB::table('ponto')->where('data', $data->toDateString())->where('controle','entrada')->where('usuario_id',$user)->first();
          $hoje = DB::table('ponto')->where('data', $data->toDateString())->where('usuario_id',$user)->get()->count();
          $bd = DB::table('users')->where('id',$user)->first();
          $nome = $bd->name;
                if($hoje >= 2){
                    return response([
                         'status' => 'erro_ja_efetuou',
                         'erro' => 'Você já efetuou sua entrada e saída hoje'
                     ]);
                }
                else if($entrada){
                      $ponto = new ponto();
                      $ponto->fill([
                      'nome' =>  $nome,
                      'usuario_id' => $user,
                      'longitude' => $longitude,
                      'latitude' => $latitude,
                      'data' => $data,
                      'horario' => $hora,
                      'controle' => 'saida'
                      ]);
                      $ponto->save();
                  }
                  else{

                    if(!empty($user)){
                      $ponto = new ponto();
                      $ponto->fill([
                      'nome' =>  $nome,
                      'usuario_id' => $user,
                      'longitude' => $longitude,
                      'latitude' => $latitude,
                      'data' => $data,
                      'horario' => $hora,
                      'controle' => 'entrada'
                      ]);
                      $ponto->save();
                    }
                  }
           return response([
                'status' => 'success',
                'json' => json_decode($response)

            ]);

      }
      else{
        return response([
          'status' => 'error_fora_trabalho',
          'erro' => 'Você está fora da área de trabalho']);
      }
    }
    public function gravar(Request $request){
        //dar um select e colocar o id na api
    }
    public function ler($id){
        //se o usuário existir
        $data = Carbon::now('America/Sao_Paulo');
        $hora = $data->format('H:i');
        $controle =DB::table('catraca')->where('usuario_id',$id)->where('data', $data->toDateString())->orderBy('created_at', 'desc')->first();
        if(User::find($id)){
            if($controle){
                if($controle->controle == "entrada"){
                    $catraca = new catraca();
                    $catraca->fill([
                        'usuario_id' => $id,
                        'data' => $data,
                        'horario' => $hora,
                        'controle' => 'saida'
                    ]);
                    $catraca->save();
                }else{
                    $catraca = new catraca();
                    $catraca->fill([
                        'usuario_id' => $id,
                        'data' => $data,
                        'horario' => $hora,
                        'controle' => 'entrada'
                    ]);
                    $catraca->save();
                }
            }else{
                $catraca = new catraca();
                $catraca->fill([
                    'usuario_id' => $id,
                    'data' => $data,
                    'horario' => $hora,
                    'controle' => 'entrada'
                ]);
                $catraca->save();
            }
            return "sucesso";
        }
        else{
            return "falha";
        }
    }
}
