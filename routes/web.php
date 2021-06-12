<?php

use App\Http\Controllers\MedecinController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


route::group(['middleware' => 'auth'], function () {
    route::resource('Medecin', MedecinController::class);
});

route::get('/test', function () {
    return view('one');
});
route::get('/', function () {
    return view('auth.login');
});
