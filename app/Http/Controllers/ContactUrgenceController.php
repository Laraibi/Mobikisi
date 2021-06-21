<?php

namespace App\Http\Controllers;

use App\Models\ContactUrgence;
use App\Models\Patient;
// use Facade\FlareClient\Http\Response;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ContactUrgenceController extends Controller
{
    //
    public function addContactToPatient(request $request)
    {
        $request->validate([
            'patient_id' => 'required|Numeric',
            'ContactFullName' => 'required|Min:6',
            'ContactType' => 'required',
            'ContactPhoneNumer' => 'required'
        ]);
        $patient=Patient::find($request->patient_id);
        if($patient){
            // $ContactUrgence=$patient->ContactsUrgence()->create();
            $ContactUrgence=new ContactUrgence();

            $ContactUrgence->patient_id=$request->patient_id;
            $ContactUrgence->FullName=$request->ContactFullName;
            $ContactUrgence->TypeContact=$request->ContactType;
            $ContactUrgence->PhoneNumber=$request->ContactPhoneNumer;
            $ContactUrgence->save();
            // return Response()->json_encode($ContactUrgence);
            return new Response($ContactUrgence,200);
        }else{
            return new Response('User unfound',404);
        }
    }
}
