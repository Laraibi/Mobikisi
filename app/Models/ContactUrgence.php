<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class ContactUrgence extends Model
{
    use HasFactory;
    protected $table='urgencecontact';
    // protected $fillable=[]
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
