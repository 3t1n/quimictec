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
        $users = DB::select('
            SELECT U.id, U.name FROM
            users U
            LEFT OUTER JOIN (SELECT homeoffice.usuario_id, homeoffice.id FROM homeoffice WHERE homeoffice.DATA = \''. $data->toDateString().'\') home 
            ON home.usuario_id = u.id
            WHERE home.id IS NULL
            LIMIT 3000;
            
            
');

        $lista = DB::table('homeoffice')
            ->join('users', 'users.id', '=', 'homeoffice.usuario_id')
            ->select('homeoffice.id','users.name','homeoffice.data')
            ->get();
        return  view('Home_Office.homeoffice',['lista' => $lista, 'users' => $users ,"data" =>  $data->toDateString()]);
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
            $home = homeoffice::find($id);
            $home->delete();
            \Session::flash('sucesso_home', 'Home Office deletado com sucesso!');
            return back()->withInput();
    }
}
