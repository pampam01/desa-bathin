<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::query();

        // Filter berdasarkan 'search' (judul berita)
        if (request()->has('search') && request()->input('search') != '') {
            $complaints->where('title', 'like', '%' . request()->input('search') . '%');
        }

        // Filter berdasarkan 'status'
        if (request()->has('status') && request()->input('status') != '') {
            $complaints->where('status', request()->input('status'));
        }

        // Filter berdasarkan 'date' (created_at)
        if (request()->has('date') && request()->input('date') != '') {
            // Menggunakan whereDate untuk pencocokan tanggal yang tepat
            $complaints->whereDate('created_at', request()->input('date'));
        } 

        // Urutkan dan paginasi hasilnya
        $complaints = $complaints->orderBy('created_at', 'desc')->paginate(10);
        $totalComplaints = $complaints->total();
        $resolvedComplaints = $complaints->where('status', 'resolved')->count();
        $rejectedComplaints = $complaints->where('status', 'rejected')->count();
        $draftComplaints = $complaints->where('status', 'draft')->count();

        return view('backend.admin.complaints.index', compact('complaints', 'totalComplaints', 'resolvedComplaints', 'rejectedComplaints', 'draftComplaints'));
    }
    
    public function pending()
    {
        $complaints = Complaint::where('status', 'pending')->get();
        return view('backend.admin.complaints.pending', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        } else {
            $data['image'] = null;
        }

        $data['user_id'] = Auth::user()->id; // Assuming the user is authenticated

        $complaint = Complaint::create($data);
        if (!$complaint) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat pengaduan.']);
        }

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'responses.user']); // Load user and responses with their users
        return view('backend.admin.complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        return view('backend.admin.complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255',
        ]);

        // Handle image upload/removal
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($complaint->image) {
                Storage::disk('public')->delete($complaint->image);
            }
            $data['image'] = $request->file('image')->store('complaints', 'public');
        } elseif ($request->remove_image) {
            // Remove existing image
            if ($complaint->image) {
                Storage::disk('public')->delete($complaint->image);
            }
            $data['image'] = null;
        }

        $data['user_id'] = Auth::user()->id;

        $complaint->update($data);

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        // Hapus gambar jika ada
        if ($complaint->image) {
            Storage::disk('public')->delete($complaint->image);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
