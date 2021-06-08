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
            return view('/settings', ['err' => 'passDiff']);
        }
        DB::table('users')->where('uuid', session('userID'))->update(['pass' => Hash::make($data['newPassword'])]);
        return view('/settings', ['code' => 'passOK']);
    }
}
