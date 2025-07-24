<?php

namespace App\Http\Controllers;

use App\Models\AboutVillage;
use App\Models\Complaint;
use App\Models\MailSubmission;
use App\Models\News;
use App\Models\NewsLike;
use App\Models\User;
use App\Models\VillageStructure;
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

        $mails = MailSubmission::all();
        $totalMailSubmissions = $mails->count();
        $newMailSubmissionsThisMonth = $mails->filter(function ($item) {
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
            'totalMailSubmissions',
            'newMailSubmissionsThisMonth',
            'totalLikes'
        ));
    }

    public function welcome()
    {
        $news = News::where('status', 'published')->latest()->take(6)->get();
        $complaints = Complaint::latest()->take(6)->get();
        $aboutVillage = AboutVillage::first();
        $totalPeople = $aboutVillage->people_total ?? 0;
        $totalFamilies = $aboutVillage->family_total ?? 0;
        $totalBloks = $aboutVillage->blok_total ?? 0;
        $totalPrograms = $aboutVillage->program_total ?? 0;
        $description = $aboutVillage->description ?? '';
        $visi = $aboutVillage->visi ?? '';
        $misi = $aboutVillage->misi ?? '';
        $location = $aboutVillage->location ?? '';
        $telp = $aboutVillage->no_telp ?? '';
        $email = $aboutVillage->email ?? '';

        // Get village structure data
        $villageStructures = [
            'kepala' => \App\Models\VillageStructure::kepala()->get(),
            'sekretaris' => \App\Models\VillageStructure::sekretaris()->get(),
            'kaur' => \App\Models\VillageStructure::kaur()->get(),
            'kasi' => \App\Models\VillageStructure::kasi()->get(),
            'kadus' => \App\Models\VillageStructure::kadus()->get(),
            'bpd' => \App\Models\VillageStructure::bpd()->get(),
        ];

        return view('frontend.index', compact('news', 'complaints', 'totalPeople', 'totalFamilies', 'totalBloks', 'totalPrograms', 'description', 'visi', 'misi', 'location', 'telp', 'email', 'villageStructures'));
    }
}
