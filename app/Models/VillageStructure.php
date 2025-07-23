<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageStructure extends Model
{
    protected $fillable = [
        'name',
        'position', 
        'level',
        'department',
        'photo',
        'description',
        'phone',
        'email',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope untuk mengambil data berdasarkan level
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level)->where('is_active', true)->orderBy('sort_order');
    }

    // Scope untuk kepala desa
    public function scopeKepala($query)
    {
        return $query->byLevel('kepala_desa');
    }

    // Scope untuk sekretaris
    public function scopeSekretaris($query)
    {
        return $query->byLevel('sekretaris');
    }

    // Scope untuk kepala urusan
    public function scopeKaur($query)
    {
        return $query->byLevel('kaur');
    }

    // Scope untuk kepala seksi
    public function scopeKasi($query)
    {
        return $query->byLevel('kasi');
    }

    // Scope untuk kepala dusun
    public function scopeKadus($query)
    {
        return $query->byLevel('kadus');
    }

    // Scope untuk BPD
    public function scopeBpd($query)
    {
        return $query->byLevel('bpd');
    }

    // Accessor untuk photo URL
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    // Method untuk mendapatkan badge class berdasarkan level
    public function getBadgeClassAttribute()
    {
        return match($this->level) {
            'kepala_desa' => '',
            'sekretaris' => 'secondary',
            'kaur' => match($this->department) {
                'Tata Usaha' => 'info',
                'Keuangan' => 'warning',
                'Perencanaan' => 'success',
                default => 'info'
            },
            'kasi' => match($this->department) {
                'Pemerintahan' => 'primary',
                'Kesejahteraan' => 'danger',
                'Pelayanan' => 'success',
                default => 'primary'
            },
            'kadus' => 'dark',
            'bpd' => 'success',
            default => 'secondary'
        };
    }

    // Method untuk mendapatkan icon berdasarkan level dan department
    public function getIconAttribute()
    {
        return match($this->level) {
            'kepala_desa' => 'bx-user-circle',
            'sekretaris' => 'bx-user',
            'kaur' => match($this->department) {
                'Tata Usaha' => 'bx-file-blank',
                'Keuangan' => 'bx-money',
                'Perencanaan' => 'bx-group',
                default => 'bx-file-blank'
            },
            'kasi' => match($this->department) {
                'Pemerintahan' => 'bx-shield-alt-2',
                'Kesejahteraan' => 'bx-heart',
                'Pelayanan' => 'bx-leaf',
                default => 'bx-shield-alt-2'
            },
            'kadus' => 'bx-map-pin',
            'bpd' => 'bx-group',
            default => 'bx-user'
        };
    }
}
