<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;
use Illuminate\Support\Facades\Storage;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Medecins = Medecin::all();
        return view('Medecin')->with('Medecins', $Medecins);
        // return view('test');
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
            'Specialite' => 'required',
            'sexe' => 'required',
            'DateOfBirth' => 'required|date',
            'photo_path' => 'mimes:jpg,bmp,png'
        ]);
        $Medecin = new Medecin($request->except('photo_path'));
        $Medecin->save();
        if ($request->has('photo_path')) {
            $request->file('photo_path')->storeAs('/public/Images/Medecins_Photos', 'Photo_Medecin_' . $Medecin->id . '.' . $request->file('photo_path')->extension());
            $Medecin->photo_path = 'Photo_Medecin_' . $Medecin->id . '.' . $request->file('photo_path')->extension();
        } else {
            $Medecin->photo_path = 'doc_default.png';
        }

        $Medecin->save();
        $Medecins = Medecin::all();
        return view('Medecin')->with(['Medecins' => $Medecins, 'successMsg' => 'Medecin Ajouté']);
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
        $Medecin = Medecin::find($id);
        return json_encode($Medecin);
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
        // echo "hello from update";
        // dd($request->photo_path);
        // dd($request);
        $request->validate([
            'fullName' => 'required',
            'Specialite' => 'required',
            'sexe' => 'required',
            'DateOfBirth' => 'required|date',
        ]);
        $Medecin = Medecin::find($id);
        if ($Medecin) {
            $Medecin->update($request->except('photo_path'));
            if ($request->has('photo_path')) {
                $request->file('photo_path')->storeAs('/public/Images/Medecins_Photos', 'Photo_Medecin_' . $Medecin->id . '.' . $request->file('photo_path')->extension());
                // dd($path);
                $Medecin->photo_path = 'Photo_Medecin_' . $Medecin->id . '.' . $request->file('photo_path')->extension();
                // dd($Medecin->photo_path);
                $Medecin->save();
            }
        }
        $Medecins = Medecin::all();
        return view('Medecin')->with(['Medecins' => $Medecins, 'successMsg' => 'Medecin Modifié']);
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
        $Medecin = Medecin::findOrFail($id);
        if ($Medecin) {
            $Medecin->delete();
            return json_encode(array('DeletedID' => $Medecin->id));
        } else {
            return response(json_encode(array('error' => 'unknown id')), 404);
        }
    }
}
