<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Patients = Patient::all();
        return view('Patient')->with('Patients', $Patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fullName' => 'required',
            'sexe' => 'required',
            'DateOfBirth' => 'required|date',
            'weight_kg' => 'required|numeric',
            'height_cm' => 'required|numeric',
            'grpSanguin' => 'required',
            'photo_path' => 'mimes:jpg,bmp,png'
        ]);
        $Patient = new Patient(['fullName' => $request->fullName]);
        $Patient->sexe = $request->sexe;
        $Patient->DateOfBirth = $request->DateOfBirth;
        $Patient->weight_kg = $request->weight_kg;
        $Patient->height_cm = $request->height_cm;
        $Patient->grpSanguin = $request->grpSanguin;
        $Patient->Mutuelle = $request->Mutuelle;
        $id = DB::select("SHOW TABLE STATUS LIKE 'patient'");
        $next_id = $id[0]->Auto_increment;
        if ($request->has('photo_path')) {
            $request->file('photo_path')->storeAs('/public/Images/Patients_Photos', 'Photo_Patient_' . $next_id . '.' . $request->file('photo_path')->extension());
            $Patient->photo_path = 'Photo_Patient_' . $next_id . '.' . $request->file('photo_path')->extension();
        } else {
            $Patient->photo_path = 'pat_default.png';
        }
        $Patient->save();
        $Patients = Patient::all();
        return view('Patient')->with(['Patients' => $Patients, 'successMsg' => 'Patient Ajouté']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Patient = Patient::find($id);
        return json_encode($Patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($id);
        $request->validate([
            'fullName' => 'required',
            'sexe' => 'required',
            'DateOfBirth' => 'required|date',
            'weight_kg' => 'required|numeric',
            'height_cm' => 'required|numeric',
            'grpSanguin' => 'required',
            'photo_path' => 'mimes:jpg,bmp,png'
        ]);
        // $Patient = new Patient(['fullName' => $request->fullName]);
        $Patient = Patient::find($id);
        $msg='Patient Introuvable';
        if($Patient){            

            $Patient->fullName = $request->fullName;
            $Patient->sexe = $request->sexe;
            $Patient->DateOfBirth = $request->DateOfBirth;
            $Patient->weight_kg = $request->weight_kg;
            $Patient->height_cm = $request->height_cm;
            $Patient->grpSanguin = $request->grpSanguin;
            $Patient->Mutuelle = $request->Mutuelle;
            if ($request->has('photo_path')) {
                $request->file('photo_path')->storeAs('/public/Images/Patients_Photos', 'Photo_Patient_' . $id . '.' . $request->file('photo_path')->extension());
                $Patient->photo_path = 'Photo_Patient_' . $id . '.' . $request->file('photo_path')->extension();
            }
            $Patient->save();
            $msg='Patient Modifié';
        }
        $Patients = Patient::all();
        return view('Patient')->with(['Patients' => $Patients, 'successMsg' => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Patient=Patient::find($id);
        if($Patient){
            $Patient->delete();
            return json_encode(array('DeletedID' => $Patient->id));
        }else{
            return response(json_encode(array('error' => 'unknown id')), 404);
        }
    }

    public function Search($query){
        $Patients=Patient::where(DB::raw('upper(fullName)'),'like','%'.strtoupper($query).'%')->get();
        return json_encode($Patients);
    }
}
