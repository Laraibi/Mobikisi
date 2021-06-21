<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Allergie extends Model
{
    use HasFactory;
    protected $table='Allergie';
    public function Patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
