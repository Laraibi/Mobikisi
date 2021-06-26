<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Traitement extends Model
{
    use HasFactory;
    
    protected $table = 'traitement';
    protected $fillable=['Date_Debut','Nom_Medicament','duree'];
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
