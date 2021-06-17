<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalFolderController extends Controller
{
    //
    public function index(){

        return view('MedicalFolder');
    }

    public function getMedicalFolder(Request $request){
        $request->validate(['PatientFN'=>'required']);

        // dd($request->PatientFN);
        $PatientNamePosted=$request->PatientFN;
        $Patient=Patient::where('fullName',$PatientNamePosted)->first();
        if($Patient){
            return view('MedicalFolder')->with('Patient',$Patient);
        }else{
            return back()->withErrors('Patient Introuvable');
        }

    }
}
