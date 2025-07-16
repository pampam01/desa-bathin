<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\News;
use App\Models\NewsLike;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        $totalNews = $news->count();
        $newsThisMonth = $news->filter(function ($item) {
            return $item->created_at->isCurrentMonth();
        })->count();
        $recentNews = $news->sortByDesc('created_at')->take(5);

        $complaints = Complaint::all();
        $totalComplaints = $complaints->count();
        $complaintsThisMonth = $complaints->filter(function ($item) {
            return $item->created_at->isCurrentMonth();
        })->count();
        $recentComplaints = $complaints->sortByDesc('created_at')->take(5);

        $users = User::all();
        $totalUsers = $users->count();
        $newUsersThisMonth = $users->filter(function ($item) {
            return $item->created_at->isCurrentMonth();
        })->count();

        $likes = NewsLike::all();
        $totalLikes = $likes->count();

        return view('backend.admin.dashboard', compact(
            'totalNews',
            'newsThisMonth',
            'recentNews',
            'totalComplaints',
            'complaintsThisMonth',
            'recentComplaints',
            'totalUsers',
            'newUsersThisMonth',
            'totalLikes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
