<?php

use App\Http\Controllers\MedecinController;
use App\Http\Controllers\MedicalFolderController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
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
    route::resource('Patient', PatientController::class);
    route::get('/SearchPatients/{query}',[PatientController::class,'Search'])->name('SearchPatients');
    route::get('/MedicalFolder',[MedicalFolderController::class,'index'])->name('MedicalFolderIndex');
    route::post('/getMedicalFolder',[MedicalFolderController::class,'getMedicalFolder'])->name('getMedicalFolder');
});

route::get('/test', function () {
    // $Patients=Patient::where('fullName','like',''.'Luf'.'*')->get(); 
    $query='luf';
    $Patients=Patient::where(DB::raw('upper(fullName)'),'like','%'.strtoupper($query).'%');
    dd($Patients);
    // return view('one');
});
route::get('/', function () {
    return view('auth.login');
});
