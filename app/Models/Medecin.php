<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $table = 'Medecin';
    protected $fillable = [
        'fullName',
        'Specialite',
        'sexe',
        'DateOfBirth'
    ];
}
