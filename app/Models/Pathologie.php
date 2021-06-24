<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
class Pathologie extends Model
{
    use HasFactory;
    protected $table = 'pathologie';
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
