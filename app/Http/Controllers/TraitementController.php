<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Traitement;
use Illuminate\Http\Request;

class TraitementController extends Controller
{
    //
    public function addTraitementToPatient(Request $request)
    {
        $request->validate([
            'patient_id' => 'Required|Numeric',
            'TraitementName' => 'Required',
            'TraitementStartDate' => 'Required|date',
            'TraitmentDurationDays' => 'Required|Numeric|min:1'
        ]);
        $Patient = Patient::find($request->patient_id);
        if ($Patient) {
            $Traitement = $Patient->Traitements()->create([
                'Date_Debut' => $request->TraitementStartDate,
                'Nom_Medicament' => $request->TraitementName,
                'duree' => $request->TraitmentDurationDays
            ]);
            // return $request->file('OrdonnanceImage');
            if ($request->has('OrdonnanceImage')) {

                $request->file('OrdonnanceImage')->storeAs('/public/Images/Ordonnances', 'Photo_Ordonnance_' . $Traitement->id . '.' . $request->file('OrdonnanceImage')->extension());
                $Traitement->ordonnance_path = 'Photo_Ordonnance_' . $Traitement->id  . '.' . $request->file('OrdonnanceImage')->extension();
                $Traitement->save();
            }
            return Response(json_encode($Traitement), 200);
        } else {
            return Response('Patient Not Found', 404);
        }
    }
    public function deleteTraitement(Request $request)
    {
        $request->validate(['TraitementID' => 'Numeric|Required']);
        $Traitement=Traitement::find($request->TraitementID);
        if($Traitement){
            $Traitement->delete();
            return Response('Traitement Deleted',200);
        }else{
            return Response('Traitement Not Found',404);
        }
    }
}
