<?php

namespace App\Http\Controllers;

use App\homeoffice;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class home_office extends Controller
{
    public function index(){
        $data = Carbon::now('America/Sao_Paulo');
        $users = DB::table('users')
            ->join('homeoffice', 'homeoffice.usuario_id', '=', 'users.id','left outer')
            ->where('homeoffice.id','=',null)
            ->select('users.name','users.id')
            ->get();

        $lista = DB::table('homeoffice')
            ->where('data', $data->toDateString())
            ->join('users', 'users.id', '=', 'homeoffice.usuario_id')
            ->get();
        return  view('Home_Office.homeoffice',['lista' => $lista, 'users' => $users ]);
    }
    public function status($id){
        $data = Carbon::now('America/Sao_Paulo');
        $verifica_data = DB::table('homeoffice')
            ->where('id',$id)
            ->where('data', $data->toDateString())->get();

        if(!$verifica_data->isNotEmpty()){
            $home = new homeoffice();
            $home->fill([
                'usuario_id' => $id,
                'data' => $data
            ]);
            $home->save();
            //Session::flash('sucesso_home', 'Sucesso!');

            //Session::flash('falha_home', 'Falha o usuário já está em home office');
        }
        return back()->withInput();
    }
    public function deletar($id){
            $data = Carbon::now('America/Sao_Paulo');
            $home = homeoffice::where('data', $data->toDateString())->where('usuario_id',"=",$id);
            $home->delete();
            \Session::flash('sucesso_home', 'Home Office deletado com sucesso!');
            return back()->withInput();
    }
}
