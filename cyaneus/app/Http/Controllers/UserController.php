<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        echo $request;
        //return redirect('dashboard');
    }

    public function create(Request $request){
        //
        if(session()->exists('user')){ //Si déjà connecté on redirige vers dashboard
            return redirect('dashboard');
        }
        //echo Hash::make("toktok");
        $data = $request->all();
        $mail = explode(".", $data['mailCreation']);
        if(!isset($mail[0]) || !isset($mail[1])){ //Syntaxe du mail incorrecte
            return redirect('/');
        }
        $prenom = ucfirst(strtolower($mail[0]));
        $nom = ucfirst(strtolower($mail[1]));
        $pass = $data['passwordCreation'];
        $passConfirm = $data['passwordConfirmCreation'];
        if($pass != $passConfirm) { //Mauvaise confirmation du mot de passe
            return redirect('/');
        }
        $users = DB::table('users')->get();
        foreach ($users as $u) {
            if($u->nom == $nom && $u->prenom == $prenom && Hash::check($passConfirm, $u->pass)){ //User connecté
                session(['user' => $prenom]);
                return redirect('dashboard');
            } else {
            }
        }
        return redirect('/'); //Mail ou mot de passe incorrect
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
