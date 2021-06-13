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

    public function addUserPicture(Request $request){
        $data = $request->all();
        print_r($data);
    }
}
