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
Route::get('/create', function () {
    return redirect('/');
});

Route::post('/login',[UserController::class, 'login']);
Route::post('/create',[UserController::class, 'create']);
Route::post('/logout',[UserController::class, 'logout']);

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

Route::get('/contact', function () {
    return view('contact');
});
