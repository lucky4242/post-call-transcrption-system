<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'call_sid',
        'phone_number',
        'recording_url',
        'transcription_text',
    ];
}
