<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\News;
use App\Models\NewsLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    
    public function masyarakat()
    {
        $news = News::all();
        $totalNews = $news->count();
        $newsThisMonth = $news->filter(function ($item) {
            return $item->created_at->isCurrentMonth();
        })->count();
        $recentNews = $news->sortByDesc('created_at')->take(5);

        $complaints = Complaint::where('user_id', Auth::user()->id)->get();
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

        $likes = NewsLike::where('user_id', Auth::user()->id)->get();
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

    public function welcome()
    {
        $news = News::latest()->take(6)->get();
        $complaints = Complaint::latest()->take(6)->get();

        return view('frontend.index', compact('news', 'complaints'));
    }

}
