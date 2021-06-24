<?php

namespace App\Http\Controllers;

use App\Models\Allergie;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AllergieController extends Controller
{
    //
    public function addAllergieToPatient(Request $request){
        $request->validate([
            'patient_id'=>'required|Numeric',
            'AllergieName'=>'required|Min:5',
            'AllergieSolution'=>'required'
        ]);
        $patient=Patient::find($request->patient_id);
        if($patient){
            $Allergie=new Allergie();
            $Allergie->patient_id=$patient->id;
            $Allergie->AllergieName=$request->AllergieName;
            $Allergie->Solution=$request->AllergieSolution;
            $Allergie->save();
            return Response($Allergie,200);
        }else{
            return Response('Patient Not Found',404);
        }

    }
    public function deleteAllergie(Request $request){
        $request->validate(['AllergieID'=>'required|Numeric']);
        $Allergie=Allergie::find($request->AllergieID);
        if($Allergie){
            $Allergie->delete();
            return Response('Allergie Deleted',200);
        }else{
            return Response('Patient Not Found',404);
        }

    }
}
