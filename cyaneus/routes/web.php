<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
