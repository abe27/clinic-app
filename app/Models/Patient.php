<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'tel',
        'hn',
        'pass_id',
        'gender_id',
        'birth_date',
        'card_id',
        'avatar',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
