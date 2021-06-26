<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Allergie;
use App\Models\Pathologie;
use App\Models\Traitement;
class Patient extends Model
{
    use HasFactory;
    protected $table = 'patient';
    protected $fillable = [
        'fullName'
    ];
    public function getGID(){
        $gid=$this->sexe . '-'.$this->DateOfBirth.'-'.str_pad($this->id, 5, "0", STR_PAD_LEFT);
        return $gid;
    }
    public function ContactsUrgence(){
        return $this->hasMany(ContactUrgence::class,'patient_id');
    }
    public function Allergies(){
        return $this->hasMany(Allergie::class,'patient_id');
    }
    public function Pathologies(){
        return $this->hasMany(Pathologie::class,'patient_id');
    }
    public function Traitements(){
        return $this->hasMany(Traitement::class,'patient_id');
    }
}
