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
        if(session()->exists('user')){ //Si déjà connecté on redirige vers dashboard
            return redirect('dashboard');
        }
        $data = $request->all();
        $mail = explode(".", $data['mailConnect']);
        if(!isset($mail[0]) || !isset($mail[1])){ //Syntaxe du mail incorrecte
            return view('/home', ['err' => 'mailSyntax']);
        }
        $prenom = ucfirst(strtolower($mail[0]));
        $nom = ucfirst(strtolower($mail[1]));
        $pass = $data['passwordConnect'];
        $users = DB::table('users')->get();
        foreach ($users as $u) {
            if($u->nom == $nom && $u->prenom == $prenom && Hash::check($pass, $u->pass)){ //User connecté
                session(['user' => $prenom]);
                return redirect('dashboard');
            }
        }
        return view('/home', ['err' => 'invalidAccount']);
    }

    public function create(Request $request){
        if(session()->exists('user')){ //Si déjà connecté on redirige vers dashboard
            return redirect('dashboard');
        }
        $data = $request->all();
        $mail = explode(".", $data['mailCreation']);
        if(!isset($mail[0]) || !isset($mail[1])){ //Syntaxe du mail incorrecte
            return view('/home', ['err' => 'mailSyntax']);
        }
        $prenom = ucfirst(strtolower($mail[0]));
        $nom = ucfirst(strtolower($mail[1]));
        $pass = $data['passwordCreation'];
        $passConfirm = $data['passwordConfirmCreation'];
        if($pass != $passConfirm){ //Confirmation du mot de passe incorecte
            return view('/home', ['err' => 'passConfirm']);
        }

        $users = DB::table('users')->get();
        foreach ($users as $u) {
            if($u->nom == $nom && $u->prenom == $prenom){ //User déjà enregistré
                return view('/home', ['err' => 'userExisting']);
            }
        }

        DB::table('users')->insert([
            'nom' => $nom,
            'prenom' => $prenom,
            'pass' => Hash::make($pass)
        ]);

        return redirect('dashboard');
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
