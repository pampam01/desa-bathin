<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSubmission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',      // <-- PENTING: user_id sekarang diizinkan
        'nik',
        'no_kk',
        'name',
        'no_hp',
        'jenis_surat',
        'description',
        'status',
        'file',
        'image',
    ];

    /**
     * Mendefinisikan relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk mendapatkan path lengkap gambar.
     */
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return null; // Mengembalikan null jika tidak ada gambar
    }
}