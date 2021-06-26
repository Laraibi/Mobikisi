<?php

namespace App\Http\Controllers;
use App\Models\Pathologie;
// use Illuminate\Http\Response;
use App\Models\Patient;
use Illuminate\Http\Request;

class PathologieController extends Controller
{
    //
    public function addPathologieToPatient(Request $request){
        $request->validate([
            'patient_id'=>'required|Numeric',
            'PathologieName'=>'required|Min:5',
            'PathologieSolution'=>'required'
        ]);
        $patient=Patient::find($request->patient_id);
        if($patient){
            $Pathologie=new Pathologie();
            $Pathologie->patient_id=$patient->id;
            $Pathologie->Name=$request->PathologieName;
            $Pathologie->solution=$request->PathologieSolution;
            $Pathologie->save();
            return Response($Pathologie,200);
        }else{
            return Response('Patient Not Found',404);
        }

    }
    public function deletePathologie(Request $request){
        $request->validate(['PathologieID'=>'required|Numeric']);
        $Pathologie=Pathologie::find($request->PathologieID);
        if($Pathologie){
            $Pathologie->delete();
            return Response('Pathologie Deleted',200);
        }else{
            return Response('Pathologie Not Found',404);
        }

    }
}
