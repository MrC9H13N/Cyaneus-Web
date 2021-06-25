<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    //Change le mot de passe en BDD
    public function changePassword(Request $request){
        $data = $request->all();
        if($data['newPassword'] != $data['newPasswordConfirm']){
            return view('/settings', ['code' => 'passDiff']);
        }
        DB::table('users')->where('uuid', session('userID'))->update(['pass' => Hash::make($data['newPassword'])]);
        return view('/settings', ['code' => 'passOK']);
    }

    //Change l'adresse en BDD
    public function changeAdress(Request $request){
        $data = $request->all();
        DB::table('users')->where('uuid', session('userID'))->update(['adresse' => $data['coord']]);
        return view('/settings', ['code' => 'adressOK']);
    }

    //Transforme la sortie de la BDD en fichier téléchargeable
    function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
        $f = fopen('php://memory', 'w');
        foreach ($array as $line) {
            fputcsv($f, $line, $delimiter);
        }
        fseek($f, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    //Permet à l'utilisateur de télécharger ses données
    public function downloadData(Request $request){
        $usrData =  DB::table('users')->where('uuid', session('userID'))->get();
        $usrData = json_decode(json_encode($usrData), true);
        self::array_to_csv_download($usrData, session('userID').'.txt');
    }

    //Permet à l'utilisateur de supprimer ses données et son compte en BDD
    public function deleteData(Request $request){
        DB::table('users')->where('uuid', session('userID'))->delete();
        DB::table('facialData')->where('uuid', session('userID'))->delete();
        session()->flush();
        return redirect('/');
    }

    //Modifie l'affichage flou ou non de ses notes
    public function changeParam(Request $request){
        $data = $request->all();
        if(isset($data['lastNote'])){
            DB::table('users')->where('uuid', session('userID'))->update(['blur' => true]);
        } else {
            DB::table('users')->where('uuid', session('userID'))->update(['blur' => false]);
        }
        return view('/settings', ['code' => 'paramOK']);
    }

    //Ajoute une photo de l'utilisateur en BDD pour la reconaissance faciale
    public function addUserPicture(Request $request){
        date_default_timezone_set('Europe/Paris');
        $data = $request->all();
        DB::table('facialData')->where('uuid', session('userID'))->update(['picture' => $data['picture']]);
        DB::table('facialData')->where('uuid', session('userID'))->update(['lastEdit' => date ('Y-m-d H:i:s', time())]);

        $data = array(
            'id' => session('userID'),
            'image' => $data['picture'],
            'action' => 1
        );
        $url = 'https://finch.hugoderave.fr/Cyaneus/cyaneus-interface.php';
        $ch = curl_init($url);
        $postString = http_build_query($data, '', '&');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        curl_close($ch);

        return $response;

        return view('/settings', ['code' => 'pictureOK']);
    }
}
