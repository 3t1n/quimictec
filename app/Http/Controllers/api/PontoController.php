<?php

namespace App\Http\Controllers\api;

use App\catraca;
use App\homeoffice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ponto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class PontoController extends Controller
{
    private $data;

    public function __construct()
    {
         $this->data = Carbon::now('America/Sao_Paulo');
    }
    private function user(){
        $user = Auth::id();
        return $user;
    }
    public function ponto(Request $request){
        $latitude = $request->input("latitude");
        $longitude = $request->input("longitude");

        //se o user estiver em home office
        if($this->home_office()){
            $this->bate_ponto("null","null","home office");
                return response([
                    'status' => 'success',
                    'json' => "home office"
                ]);
        }else{
            //verifica se ele passou a catraca
            if($this->catraca()){
                //verifica a geolocalizacao
                if($this->geolocalizacao($latitude,$longitude)){
                    if($this->bate_ponto($latitude,$longitude,"normal")){
                        $endpoint = "https://us1.locationiq.com/v1/reverse.php?key=43706011dbee3d&lat=".$latitude."&lon=".$longitude."&format=json";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $endpoint);
                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close ($ch);
                        return response([
                            'status' => 'success',
                            'json' => json_decode($response)

                        ]);
                    }else{
                        return response([
                            'status' => 'erro_ja_efetuou',
                            'erro' => 'Você já efetuou sua entrada e saída hoje'
                        ]);
                    }
                }else{
                    return response([
                        'status' => 'error_fora_trabalho',
                        'erro' => 'Você está fora da área de trabalho']);
                }
            }else{
                return response([
                    'status' => 'error_fora_trabalho',
                    'erro' => 'Não passou entrou na empresa e passou a catraca!']);
            }

        }
    }
    private function bate_ponto($latitude,$longitude,$forma){
        $bd = DB::table('users')->where('id',$this->user() )->first();
        $nome = $bd->name;
        $hora =   $this->data->format('H:i');
        $entrada = DB::table('ponto')->where('data', $this->data->toDateString())->where('controle','entrada')->where('usuario_id',$this->user())->first();
        $hoje = DB::table('ponto')->where('data', $this->data->toDateString())->where('usuario_id',$this->user())->get()->count();
        if($hoje >= 2){
            return false;
        }
        else if($entrada){
            $ponto = new ponto();
            $ponto->fill([
                'nome' =>  $nome,
                'usuario_id' => $this->user(),
                'longitude' => $longitude,
                'latitude' => $latitude,
                'data' => $this->data,
                'horario' => $hora,
                'controle' => 'saida',
                'forma' => $forma
            ]);
            $ponto->save();
            return true;
        }
        else{
            if(!empty($this->user())){
                $ponto = new ponto();
                $ponto->fill([
                    'nome' =>  $nome,
                    'usuario_id' => $this->user(),
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'data' => $this->data,
                    'horario' => $hora,
                    'controle' => 'entrada',
                    'forma' => $forma
                ]);
                $ponto->save();
            }
            return true;
        }
    }
    private function home_office(){

        $homeoffice =  DB::table('homeoffice')
            ->where('usuario_id',$this->user())
            ->where('data', $this->data->toDateString())->first();
        if($homeoffice){
            return true;
        }
        else{
            return false;
        }
    }
    private function catraca(){
        $controle = DB::table('catraca')->where('usuario_id',$this->user())
            ->where('data', $this->data->toDateString())
            ->orderBy('created_at', 'desc')
            ->first();
        if(
        if(!empty($controle->controle == "entrada")){
            return true;
        }
        else{
            return false;
        }
    }
    private function geolocalizacao($latitude, $longitude){
        $valida_long = (-23.52000>=$latitude)&&($latitude>=-23.54999);
        $valida_lat = (-46.00000>=$longitude)&&($longitude>=-49.66999);
        if($valida_long  &&  $valida_lat  ){
            return true;
        }
        else{
            return false;

        }
    }
    public function gravar(Request $request){
        //dar um select e colocar o id na api
    }
    public function ler($id){
        //se o usuário existir
        if(User::find($id)){
            return "sucesso";
        }
        else{
            return "falha";
        }
    }
    public function registra($id){
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
