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

    function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        // loop over the input array
        foreach ($array as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    }


    public function downloadData(Request $request){
        $usrData =  DB::table('users')->where('uuid', session('userID'))->get();
        $usrData = json_decode(json_encode($usrData), true);
        self::array_to_csv_download($usrData, session('userID').'.txt');
    }

    public function deleteData(Request $request){
        DB::table('users')->where('uuid', session('userID'))->delete();
        DB::table('facialData')->where('uuid', session('userID'))->delete();
        session()->flush();
        return redirect('/');
    }

    public function changeParam(Request $request){
        $data = $request->all();
        if(isset($data['lastNote'])){
            DB::table('users')->where('uuid', session('userID'))->update(['blur' => true]);
        } else {
            DB::table('users')->where('uuid', session('userID'))->update(['blur' => false]);
        }
        return view('/settings', ['code' => 'paramOK']);
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
