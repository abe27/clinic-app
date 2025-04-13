<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    protected $fillable = [
        'patient_id',
        'remark',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
