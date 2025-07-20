<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutVillage extends Model
{
    protected $fillable = [
        'people_total',
        'family_total', 
        'blok_total',
        'program_total',
        'description',
        'visi',
        'misi',
        'location',
        'no_telp',
        'email'
    ];

    protected $casts = [
        'people_total' => 'integer',
        'family_total' => 'integer',
        'blok_total' => 'integer',
        'program_total' => 'integer'
    ];
}
