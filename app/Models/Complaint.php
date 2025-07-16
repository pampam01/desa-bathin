<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [
        'id',
    ];

    /**
     * Get the user that owns the complaint.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the responses for the complaint.
     */
    public function responses()
    {
        return $this->hasMany(ComplaintResponse::class);
    }

    /**
     * Get the latest response for the complaint.
     */
    public function latestResponse()
    {
        return $this->hasOne(ComplaintResponse::class)->latest();
    }

    // Additional methods or relationships can be added here as needed
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        } 
        if ($filters['status'] ?? false) {
            $query->where('status', $filters['status']);
        }
        if ($filters['date'] ?? false) {
            $query->whereDate('created_at', $filters['date']);
        }
    }
}
