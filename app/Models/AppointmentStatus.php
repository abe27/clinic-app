<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AppointmentStatus extends Model
{
    use HasFactory, Notifiable, HasUlids;
    protected $fillable = [
        'name',
        'sequence',
    ];
}
