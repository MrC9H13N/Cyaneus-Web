<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //Renvoie un UUIDV4
    public static function v4() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    //Vérification des informations de connexion fournies par l'utilisateur
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
                session(['userName' => $u->prenom]);
                session(['userID' => $u->uuid]);
                return redirect('dashboard');
            }
        }
        return view('/home', ['err' => 'invalidAccount']);
    }

    //Création d'un compte utlisateur en BDD
    public function create(Request $request){
        if(session()->exists('user')){ //Si déjà connecté on redirige vers dashboard
            return redirect('dashboard');
        }
        $data = $request->all();
        //$mailWhitoutA = substr($data['mailCreation'], 0, strpos($data['mailCreation'], "@"));
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
        $uuidV4 = self::v4();
        DB::table('users')->insert([
            'uuid' => $uuidV4,
            'nom' => $nom,
            'prenom' => $prenom,
            'pass' => Hash::make($pass)
        ]);
        DB::table('facialData')->insert([
            'uuid' => $uuidV4,
            'picture' => null,
            'lastEdit' => null
        ]);
        session(['userName' => $prenom]);
        session(['userID' => $uuidV4]);
        return redirect('dashboard');
    }

    //Connexion d'un utilisteur par reconaissance faciale
    public function connectUserWithPicture(Request $request){

        $data = $request->all();
        $mail = explode(".", $data['mail']);
        if(!isset($mail[0]) || !isset($mail[1])){ //Syntaxe du mail incorrecte
            return("erreur");
        }
        $prenom = ucfirst(strtolower($mail[0]));
        $nom = ucfirst(strtolower($mail[1]));

        $id = DB::table('users')
            ->where('prenom', '=', $prenom)
            ->where('nom', '=', $nom)
            ->value('uuid');

        $data = array(
            'id' => $id,
            'image' => $data['picture'],
            'action' => 2
        );
        $url = 'https://finch.hugoderave.fr/Cyaneus/cyaneus-interface.php';
        $ch = curl_init($url);
        $postString = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        curl_close($ch);
        //Connect user
        $users = DB::table('users')->get();
        foreach ($users as $u) {
            if($u->nom == $nom && $u->prenom == $prenom){ //User connecté
                session(['userName' => $u->prenom]);
                session(['userID' => $u->uuid]);
            }
        }


        return $response;
    }

    //Déconnexion de l'utilisateur
    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
