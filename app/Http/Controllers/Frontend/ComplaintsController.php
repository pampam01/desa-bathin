<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::latest();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        // Category filter if needed
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        $complaints = $query->paginate(9);
        
        return view('frontend.complaints.index', compact('complaints'));
    }
    
    public function show($id)
    {
        $complaints = Complaint::findOrFail($id);
        
        // Get related complaints
        $relatedComplaints = Complaint::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.complaints.show', compact('complaints', 'relatedComplaints'));
    }
}
