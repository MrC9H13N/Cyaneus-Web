<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return redirect('/');
});

Route::get('/notes', function () {
    return view('notes');
});

Route::get('/create', function () {
    return redirect('/');
});

Route::post('/login',[UserController::class, 'login']);
Route::post('/create',[UserController::class, 'create']);
Route::post('/logout',[UserController::class, 'logout']);
Route::get('/logout',[UserController::class, 'logout']);

Route::get('/agenda', function () {
    return view('agenda');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::post('/changePassword',[SettingsController::class, 'changePassword']);
Route::post('/changeAdress',[SettingsController::class, 'changeAdress']);
Route::post('/addUserPicture',[SettingsController::class, 'addUserPicture']);
Route::post('/sendCropRequest',[SettingsController::class, 'sendCropRequest']);
Route::post('/changeParam',[SettingsController::class, 'changeParam']);
Route::post('/downloadData',[SettingsController::class, 'downloadData']);
Route::post('/deleteData',[SettingsController::class, 'deleteData']);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/frs', function () { //Facial recognition setup
    return view('frs');
});

Route::get('/frl', function () { //Facial recognition login
    return view('frl');
});

Route::post('/connectUserWithPicture',[UserController::class, 'connectUserWithPicture']);
