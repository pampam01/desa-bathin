<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSubmission extends Model
{
    protected $guarded = [
        'id',
    ]; 
    protected $fillable = [
        'name',
        'no_hp',
        'email',
        'message',
        'image',
        'status',
        'file',
    ];

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
    
}
