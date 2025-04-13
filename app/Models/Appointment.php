<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'appointment_date',
        'status_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
    }
}
