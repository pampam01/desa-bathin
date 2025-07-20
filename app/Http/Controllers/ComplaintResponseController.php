<?php

namespace App\Http\Controllers;

use App\Models\ComplaintResponse;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ComplaintResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $responses = ComplaintResponse::with(['complaint', 'user']);

        // Filter berdasarkan judul
        if ($request->filled('search')) {
            $responses->whereHas('complaint', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $responses->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->filled('date')) {
            $responses->whereDate('created_at', $request->date);
        }

        // Filter by complaint_id jika diperlukan (opsional)
        if ($request->filled('complaint_id')) {
            $responses->where('complaint_id', $request->complaint_id);
        }

        // Pagination
        $responses = $responses->orderBy('created_at', 'desc')->paginate(10);

        // Hitung statistik berdasarkan status dari semua data (bukan hanya 1 halaman)
        $allResponses = ComplaintResponse::query();
        $totalResponses = $allResponses->count();
        $resolvedResponses = $responses->where('status', 'resolved')->count();
        $pendingResponses = $responses->where('status', 'pending')->count();
        $processResponses = $responses->where('status', 'process')->count();

        return view('backend.admin.responses.index', compact(
            'responses',
            'totalResponses',
            'resolvedResponses',
            'pendingResponses',
            'processResponses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $complaints = Complaint::with('user')->get();
        $users = User::where('role', 'admin')->get();
        
        // Get complaint_id from URL parameter if provided
        $selectedComplaintId = $request->get('complaint_id');
        $selectedComplaint = null;

        if ($selectedComplaintId) {
            $selectedComplaint = Complaint::with('user')->find($selectedComplaintId);
        }

        return view('backend.admin.responses.create', compact('complaints', 'selectedComplaintId', 'selectedComplaint', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'response' => 'required|string|max:5000',
            'status' => 'required|in:pending,process,resolved',
        ]);

        $data = $request->all();
        
        // Always use the authenticated user as the responder
        $data['user_id'] = Auth::id();

        $response = ComplaintResponse::create($data);

        return redirect()->route('complaint-response.show', $response->id)
            ->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintResponse $complaintResponse)
    {
        $response = $complaintResponse->load(['complaint', 'user']);

        // Get all responses for this complaint
        $allResponses = ComplaintResponse::with(['user'])
            ->where('complaint_id', $response->complaint_id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Get users for dropdown
        $users = User::all();

        return view('backend.admin.responses.show', compact('response', 'allResponses', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintResponse $complaintResponse)
    {
        $response = $complaintResponse->load(['complaint', 'user']);
        $complaints = Complaint::all();
        $users = User::all();

        return view('backend.admin.responses.edit', compact('response', 'complaints', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintResponse $complaintResponse)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'response' => 'required|string|max:5000',
            'status' => 'required|in:pending,process,resolved',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $data = $request->all();

        // If user_id is not provided, keep current user
        if (!$data['user_id']) {
            $data['user_id'] = $complaintResponse->user_id;
        }

        $complaintResponse->update($data);

        return redirect()->route('complaint-response.show', $complaintResponse->id)
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintResponse $complaintResponse)
    {
        $complaintId = $complaintResponse->complaint_id;
        $complaintResponse->delete();

        // Redirect to complaint responses index or back to complaint detail
        return redirect()->route('complaint-response.index')
            ->with('success', 'Tanggapan berhasil dihapus.');
    }

    /**
     * Get complaint details via AJAX
     */
    public function getComplaintDetails($id)
    {
        try {
            $complaint = Complaint::with('user')->find($id);
            
            if (!$complaint) {
                return response()->json(['error' => 'Complaint not found'], 404);
            }
            
            return response()->json($complaint);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
