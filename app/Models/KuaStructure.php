<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuaStructure extends Model
{
    protected $table = 'kua_structures';

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

    // Scope untuk kepala kemenag
    public function scopeKepalaKemenag($query)
    {
        return $query->byLevel('kepala_kemenag');
    }

    // Scope untuk kesubagg tu
    public function scopeKesubaggTu($query)
    {
        return $query->byLevel('kesubagg_tu');
    }

    // Scope untuk kasi bimas islam
    public function scopeKasiBimasIslam($query)
    {
        return $query->byLevel('kasi_bimas_islam');
    }

    // Scope untuk kepala kua
    public function scopeKepalaKua($query)
    {
        return $query->byLevel('kepala_kua');
    }

    // Scope untuk pengadministrasi
    public function scopePengadministrasi($query)
    {
        return $query->byLevel('pengadministrasi');
    }

    // Scope untuk operator simkah
    public function scopeOperatorSimkah($query)
    {
        return $query->byLevel('operator_simkah');
    }

    // Scope untuk pramu kantor
    public function scopePramuKantor($query)
    {
        return $query->byLevel('pramu_kantor');
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
            'kepala_kemenag' => 'primary',
            'kesubagg_tu' => 'secondary',
            'kasi_bimas_islam' => 'info',
            'kepala_kua' => 'warning',
            'pengadministrasi' => 'success',
            'operator_simkah' => 'danger',
            'pramu_kantor' => 'dark',
            default => 'secondary'
        };
    }

    // Method untuk mendapatkan icon berdasarkan level dan department
    public function getIconAttribute()
    {
        return match($this->level) {
            'kepala_kemenag' => 'bx-user-circle',
            'kesubagg_tu' => 'bx-user',
            'kasi_bimas_islam' => 'bx-book-open',
            'kepala_kua' => 'bx-mosque',
            'pengadministrasi' => 'bx-file-blank',
            'operator_simkah' => 'bx-computer',
            'pramu_kantor' => 'bx-support',
            default => 'bx-user'
        };
    }
}
