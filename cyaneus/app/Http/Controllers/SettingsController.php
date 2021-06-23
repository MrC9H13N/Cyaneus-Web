<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    public function changePassword(Request $request){
        $data = $request->all();
        if($data['newPassword'] != $data['newPasswordConfirm']){
            return view('/settings', ['code' => 'passDiff']);
        }
        DB::table('users')->where('uuid', session('userID'))->update(['pass' => Hash::make($data['newPassword'])]);
        return view('/settings', ['code' => 'passOK']);
    }

    public function changeAdress(Request $request){
        $data = $request->all();
        DB::table('users')->where('uuid', session('userID'))->update(['adresse' => $data['coord']]);
        return view('/settings', ['code' => 'adressOK']);
    }

    public function changeParam(Request $request){
        $data = $request->all();
        echo $data['lastNote'];
        if(isset($data['lastNote'])){
            echo "OUI";
        } else {
            echo "NON";
        }
        //DB::table('users')->where('uuid', session('userID'))->update(['adresse' => $data['coord']]);
        //return view('/settings', ['code' => 'paramOK']);
    }

    public function addUserPicture(Request $request){
        date_default_timezone_set('Europe/Paris');
        $data = $request->all();
        DB::table('facialData')->where('uuid', session('userID'))->update(['picture' => $data['picture']]);
        DB::table('facialData')->where('uuid', session('userID'))->update(['lastEdit' => date ('Y-m-d H:i:s', time())]);
        return view('/settings', ['code' => 'pictureOK']);
    }

    public function sendCropRequest(Request $request){
        $data = array(
            'id' => session('userID'),
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
    }
}
